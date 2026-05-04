# PDF & Certificate Security Best Practices

## Overview
This document outlines best practices for safely storing and displaying certificates and PDFs on your portfolio website without compromising sensitive information or exposing private data.

---

## 1. File Organization & Storage

### Recommended Structure
```
/frontend/public/certificates/
├── certified-courses/
│   ├── certificate-name-1.pdf
│   └── certificate-name-2.pdf
├── diplomas/
│   └── diploma-issued-name.pdf
└── achievements/
    └── achievement-badge.pdf
```

### Storage Rules
- ✅ **DO**: Store only publicly-shareable, non-sensitive files in `/public`
- ❌ **DON'T**: Place files with sensitive information in `/public`:
  - Full social security numbers
  - Passport numbers or ID card images
  - Home addresses
  - Personal banking information
  - Medical records
  - Classified or confidential information

---

## 2. File Naming Conventions

Use descriptive, privacy-friendly names:

```
✅ GOOD:
- AWS-Cloud-Practitioner-Certificate.pdf
- CompTIA-Security-Plus-Achievement.pdf
- Cybersecurity-Fundamentals-Course.pdf

❌ AVOID:
- Luis_Full_SSN_Certificate_123-45-6789.pdf
- Personal_ID_Document_Luis_Ernesto.pdf
- Invoice_With_Address_And_Phone.pdf
```

---

## 3. Git Repository Security

### .gitignore Configuration
Ensure sensitive files are never committed to Git:

```
# Sensitive documents (add to .gitignore)
/frontend/public/certificates/private/
/frontend/public/certificates/**/*-sensitive.*
/frontend/public/certificates/**/*-personal.*
*.pem
*.key
.env
.env.local
secrets.json
```

### Verify No Sensitive Data in History
```bash
# Check for sensitive patterns in Git history
git log -p --all -S "SSN\|password\|secret" -- "frontend/public/"

# Search for large binary files that might contain sensitive data
git rev-list --all --objects | grep -E "\.(pdf|docx|xlsx)$" | sort -k2
```

---

## 4. Redaction Best Practices

Before uploading any document to public repositories:

1. **Use PDF Redaction Tools**:
   - Adobe Acrobat Reader: Edit → Redact
   - Free alternatives: LibreOffice Draw, Preview (macOS)
   - Command line: `pdftk`, `ghostscript`

2. **Information to Redact**:
   - Full names (if privacy desired)
   - Addresses or postal codes
   - Email addresses (if not meant to be public)
   - Phone numbers
   - Identification numbers
   - Financial information
   - Dates of birth
   - Signature blocks (for diplomatic/confidential docs)

3. **Verify Redaction**:
   ```bash
   # Ensure text is actually removed, not just covered
   # Use pdftotext to extract text and verify
   pdftotext redacted-document.pdf - | grep -i "sensitive-word"
   ```

---

## 5. Access Control

### Production Deployment
Even though files are in `/public`, consider additional controls:

```javascript
// Optional: Server-side validation (backend/src/routes/certificates.routes.js)
router.get('/certificates/:filename', (req, res) => {
  const allowedFiles = [
    'AWS-Cloud-Practitioner-Certificate.pdf',
    'CompTIA-Security-Plus-Achievement.pdf',
    // Only list public-approved files
  ];

  if (!allowedFiles.includes(req.params.filename)) {
    return res.status(404).json({ error: 'Certificate not found' });
  }

  res.sendFile(`/path/to/public/certificates/${req.params.filename}`);
});
```

### Content Security Policy (CSP)
Add to your Astro config for additional protection:

```javascript
// astro.config.mjs
export default defineConfig({
  vite: {
    ssr: {
      external: ['pdfjs-dist']
    }
  },
  integrations: [
    {
      hooks: {
        'astro:server:setup': ({ server }) => {
          server.middlewares.use((req, res, next) => {
            // Prevent embedding PDFs outside your domain
            res.setHeader('X-Content-Type-Options', 'nosniff');
            res.setHeader('X-Frame-Options', 'SAMEORIGIN');
            next();
          });
        }
      }
    }
  ]
});
```

---

## 6. PDF.js Security Considerations

Your implementation uses PDF.js which is safe, but:

✅ **Already Protected**:
- PDF.js sandboxes PDF rendering
- No automatic script execution
- Canvas-based rendering prevents direct PDF embedding exploits

⚠️ **Best Practices**:
- Always use the official `pdfjs-dist` from npm, not arbitrary sources
- Keep the library updated: `npm update pdfjs-dist`
- Verify checksums: `npm audit`

```bash
# Check for security vulnerabilities in pdfjs-dist
npm audit pdfjs-dist

# Update to latest secure version
npm install pdfjs-dist@latest
```

---

## 7. User Privacy

### Analytics & Logging
Don't log sensitive information about PDF access:

```javascript
// ❌ DON'T DO THIS
console.log(`User downloaded: ${fullUserData}-certificate.pdf`);

// ✅ DO THIS
console.log(`Certificate accessed: certificate_type_general`);
```

### Avoid Tracking Sensitive Patterns
- Don't track which specific certificates users view if they contain personal info
- Don't log file download times correlated with sensitive events
- Consider disabling analytics for certificate pages if needed

---

## 8. Deployment Checklist

Before going to production:

- [ ] No sensitive files in `/public/certificates/`
- [ ] `.gitignore` excludes all private/sensitive files
- [ ] Git history checked for accidental sensitive file commits
- [ ] All PDFs redacted where necessary
- [ ] File names don't contain PII or sensitive data
- [ ] `pdfjs-dist` is up-to-date and from npm
- [ ] `.env` files are in `.gitignore` and never committed
- [ ] Backup sensitive files separately (outside Git)
- [ ] Server headers configured (X-Content-Type-Options, etc.)
- [ ] PDF viewer tested on multiple devices and browsers

---

## 9. If Sensitive Data Was Committed to Git

### Remove File from History
```bash
# Using git filter-branch (permanent removal)
git filter-branch --tree-filter 'rm -f frontend/public/certificates/sensitive-file.pdf' HEAD

# Or use git-filter-repo (recommended, faster)
git filter-repo --path frontend/public/certificates/sensitive-file.pdf --invert-paths

# Force push (use with caution!)
git push origin --force-all
```

### Notify Users
- Alert users that a file with sensitive data was exposed
- Provide timeline of exposure
- Recommend preventative actions

---

## 10. Backup & Recovery

### Keep Secure Backups
```bash
# Encrypted backup of sensitive files (NOT in Git)
# Use OS-level encryption or dedicated backup tools
# Example: macOS encrypted disk image, Windows BitLocker, or hardware encrypted USB

# Document structure for your own reference:
# certificates/
#   ├── public/ (what's in Git)
#   └── private/ (encrypted backup, .gitignored)
```

### Recovery Plan
- Store encrypted backups in secure location
- Document which certificates are public vs. private
- Periodically review what's in `/public/certificates/`

---

## Summary

**Key Takeaways:**
1. Only store truly public certificates in `/frontend/public/certificates/`
2. Redact sensitive information before uploading
3. Use `.gitignore` to prevent commits of private files
4. Keep `pdfjs-dist` updated for security patches
5. Implement server-side access controls if needed
6. Monitor Git history for accidental sensitive data commits
7. Use descriptive, privacy-friendly file names
8. Test thoroughly before production deployment

---

## References

- [OWASP: Sensitive Data Exposure](https://owasp.org/www-project-top-ten/)
- [PDF.js Security](https://mozilla.github.io/pdf.js/getting_started/)
- [Git Security Best Practices](https://git-scm.com/book/en/v2/Git-Tools-Credential-Storage)
- [CWE-200: Exposure of Sensitive Information](https://cwe.mitre.org/data/definitions/200.html)
