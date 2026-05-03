function shallowSanitize(obj) {
  if (!obj || typeof obj !== 'object') return obj;
  // Only sanitize own enumerable properties, shallow copy to avoid prototype issues
  const out = Array.isArray(obj) ? [] : {};
  for (const key of Object.keys(obj)) {
    if (typeof key !== 'string') continue;
    // Prevent prototype pollution / NoSQL operators
    if (key.startsWith('$') || key.includes('.')) continue;
    const val = obj[key];
    if (typeof val === 'string') {
      // Minimal XSS protection: strip script tags and escape <, >, &
      out[key] = val.replace(/<script.*?>.*?<\/script>/gi, '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
    } else {
      // Leave other types untouched (avoid deep recursion to reduce errors)
      out[key] = val;
    }
  }
  return out;
}

export default function sanitizeInputs(req, _res, next) {
  try {
    if (req.body && typeof req.body === 'object') req.body = shallowSanitize(req.body);
    if (req.query && typeof req.query === 'object') req.query = shallowSanitize(req.query);
    if (req.params && typeof req.params === 'object') req.params = shallowSanitize(req.params);
    return next();
  } catch (e) {
    // If sanitization fails, forward error to centralized handler
    return next(e);
  }
}
