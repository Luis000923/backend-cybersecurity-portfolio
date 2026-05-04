# PDF Preview Implementation Guide

## 🎯 What's New

Your certificate section now features a complete PDF preview and lightbox system with:

- **First-page preview thumbnails** on certificate cards
- **Modal viewer** that opens without leaving the page
- **Mobile-optimized** with swipe gestures and touch support
- **Keyboard navigation** (arrow keys, Escape)
- **Responsive design** for all screen sizes

---

## 🚀 How It Works

### User Flow
1. User visits `/certificates` page
2. Each PDF certificate displays as a card with first-page preview
3. Clicking the card opens a full-screen modal viewer
4. User can:
   - Navigate pages with next/previous buttons
   - Use arrow keys (desktop) or swipe (mobile)
   - Download the PDF
   - Close with Escape key or X button

### Technical Architecture

```
CertificateCard.astro
├── PdfPreviewThumbnail.astro (renders first page preview)
├── PdfViewer.astro (handles modal + full viewing)
└── Regular images (for .jpg, .png, etc.)
```

---

## 📱 Features Breakdown

### Desktop Experience
- Clean modal with full controls
- Keyboard shortcuts (← → for pages, Esc to close)
- Optimized rendering at scale 2x
- Full header with all controls visible

### Mobile Experience
- Optimized modal dimensions
- Touch-friendly buttons with increased padding
- Swipe gestures for page navigation (±50px threshold)
- Responsive scale (1.2x to prevent lag)
- Full-screen friendly dimensions (95vw × 95vh)

### Preview Thumbnails
- Renders first page automatically on card load
- Shows loading state while rendering
- Error handling if PDF fails to load
- Smooth fade-in animation on hover

---

## 🛠️ Configuration

### File Locations
```
frontend/public/certificates/
├── certificate-1.pdf
├── certificate-2.pdf
└── diploma.pdf
```

Files are automatically detected from this directory and displayed on the certificates page.

### Naming Convention
Use descriptive names without sensitive info:
```
✅ AWS-Solutions-Architect-Associate.pdf
❌ My_Personal_Certificate_With_SSN_123-45-6789.pdf
```

---

## ⚙️ Customization

### Change Preview Scale
Edit `PdfPreviewThumbnail.astro` line ~53:
```javascript
const scale = 1.5; // Adjust preview quality (higher = better quality, slower load)
```

### Adjust Modal Size
Edit `PdfViewer.astro` modal class:
```astro
<dialog class="max-w-4xl max-h-[90vh]"> <!-- Change these values -->
```

### Mobile Button Size
Edit `PdfViewer.astro` header buttons:
```html
<svg class="w-4 h-4 md:w-5 md:h-5"> <!-- Adjust w-4/md:w-5 ratio -->
```

### Swipe Sensitivity
Edit `PdfViewer.astro` script, line ~95:
```javascript
if (Math.abs(diff) > 50) { // Lower = more sensitive, higher = need bigger swipe
```

---

## 🔒 Security Notes

### What's Safe to Upload
✅ Public certificates and achievements
✅ Diplomas without sensitive dates
✅ Course completion badges
✅ Award acknowledgments

### What to Avoid
❌ Documents with SSN, ID numbers
❌ Personal addresses or phone numbers
❌ Sensitive business information
❌ Private credentials or tokens
❌ Medical or financial records

**See `DOC/PDF_CERTIFICATE_SECURITY.md` for comprehensive security guidelines**

---

## 🧪 Testing

### Test Checklist
```
Desktop Testing:
□ PDFs display preview on cards
□ Click card opens modal
□ Arrow keys navigate pages
□ Escape closes modal
□ Download button works
□ Page counter displays correctly

Mobile Testing:
□ Preview renders (may be slower on low-end devices)
□ Modal fits on screen
□ Buttons are touch-friendly
□ Swipe left/right navigates pages
□ Zoom works properly

Cross-browser:
□ Chrome/Edge
□ Firefox
□ Safari
□ Mobile Safari (iOS)
□ Chrome Mobile (Android)
```

### Local Testing
```bash
cd frontend
npm run dev
# Visit http://localhost:3000/certificates
```

---

## 🐛 Troubleshooting

### PDFs Not Showing Preview
**Issue**: Canvas displays blank or shows error
**Solutions**:
- Verify PDF file is valid and not corrupted
- Check PDF file size (very large PDFs may need scale adjustment)
- Check browser console for error messages
- Try opening in separate tab to verify PDF works

### Modal Not Opening
**Issue**: Clicking card does nothing
**Solutions**:
- Clear browser cache
- Check browser console for JavaScript errors
- Verify `pdfjs-dist` is properly installed
- Try refreshing the page

### Performance Issues on Mobile
**Issue**: Slow loading or lag
**Solutions**:
- Lower the preview scale in `PdfPreviewThumbnail.astro`
- Reduce PDF file size
- Check if device has sufficient RAM
- Try on a different device to isolate issue

### Swipe Not Working
**Issue**: Swiping on mobile doesn't change pages
**Solutions**:
- Ensure swipe distance > 50px (adjustable in code)
- Try slower, deliberate swipes
- Check that touch events aren't blocked by CSS

---

## 📚 File Structure

### New Components
```
frontend/src/components/
└── PdfPreviewThumbnail.astro (NEW - handles first page preview)

Modified Components
├── CertificateCard.astro (now uses preview thumbnail)
└── PdfViewer.astro (enhanced mobile support + gestures)
```

### Documentation
```
DOC/
└── PDF_CERTIFICATE_SECURITY.md (NEW - security best practices)
```

---

## 🔄 Dependencies

Already installed (no additional setup needed):
- `pdfjs-dist` (^5.7.284) - PDF rendering engine

---

## 🎨 Styling Notes

The implementation uses your existing design system:
- Uses CSS custom properties (`--bg-1`, `--accent`, etc.)
- Tailwind CSS for responsive utilities
- Maintains design consistency with site

No additional CSS files or design changes needed.

---

## 📝 Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile Safari (iOS 14+)
- ✅ Chrome Android

PDF.js provides polyfills for older browsers but performance may vary.

---

## 🚀 Next Steps (Optional)

Consider these enhancements for the future:

1. **Zoom Controls**: Add zoom in/out buttons
2. **Thumbnail Strip**: Show all pages as thumbnails for quick navigation
3. **Search**: Add ability to search text within PDFs
4. **Dark Mode**: Toggle for PDF rendering theme
5. **Annotations**: Allow users to highlight or note PDFs (client-side only)
6. **Caching**: Cache rendered pages in IndexedDB for faster navigation
7. **Progressive Loading**: Load pages on-demand instead of rendering all at once

---

## 💡 Tips

- **Optimize PDFs**: Use tools like `pdfcompress.com` or ImageMagick to reduce file size
- **Batch Processing**: Use scripts to generate thumbnails offline for faster loading
- **Analytics**: Track which certificates are viewed to understand user interests
- **Organization**: Create subdirectories in `/public/certificates/` to organize by type

---

## 📞 Questions?

Refer to:
- [PDF.js Documentation](https://mozilla.github.io/pdf.js/)
- [Astro Components Guide](https://docs.astro.build/en/basics/astro-components/)
- `DOC/PDF_CERTIFICATE_SECURITY.md` for security questions
- `DOC/ARCHITECTURE.md` for system overview
