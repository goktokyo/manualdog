# ManualDog - Development Specification (v1.1.0)

**Last Updated:** 2026-03-25
**Author:** Goji Kawai @ Espicurio Inc.
**AI Co-pilot:** gemi-chan

---

## 1. Project Overview

### 1.1. Purpose & Goal
The primary goal of ManualDog is to **facilitate smooth and continuous communication** between WordPress site creators and their clients (or site operators).

### 1.2. Problem to Solve
Traditional manual management using PDFs or external documents often leads to information becoming outdated or lost after site delivery. This plugin solves this by providing a **"living manual"** directly within the WordPress dashboard—the place where users work most—ensuring that the latest information is always accessible.

### 1.3. Target Audience
*   Web Developers & Agencies
*   WordPress Site Administrators
*   Content Editors & Site Operators

---

## 2. Core Features (v1.1.0)

### 2.1. Custom Post Type: `manualdog_manual`
*   **Admin-Facing Only:** Content is not displayed on the front-end (`public: false`).
*   **Gutenberg Ready:** Fully compatible with the block editor.
*   **Hierarchical Structure:** Supports parent-child relationships (`hierarchical: true`).

### 2.2. Dedicated Manual Viewer (View Manuals)
*   **Immersive UI:** A clean, two-column layout (navigation sidebar + content area).
*   **Responsive Design:** Fully responsive for desktop and mobile devices.
*   **Persistent Navigation:** A hierarchical navigation sidebar is always visible.
*   **Read-Only:** Simple browsing interface with no management UI.

### 2.3. Hierarchical Pager
*   "Previous" and "Next" navigation links correctly follow the hierarchical structure.

### 2.4. All Manuals Page (v1.1.0)
*   **Table View:** Displays all manuals in a `wp-list-table` style table with Title, Author, Date, and Actions columns.
*   **Hierarchical Indent:** Child manuals are visually indented with a `└` symbol.
*   **Title Links:** Titles link directly to the Gutenberg edit screen.
*   **Edit & Trash:** Each row provides Edit and Trash action links.
*   **Add New Button:** A prominent button links to the new manual creation screen.

### 2.5. Sort Order Page (v1.1.0)
*   **Drag-and-Drop Sorting:** Uses nestable2 library for intuitive reordering.
*   **Nesting Support:** Drag items right to nest (create child), left to un-nest (promote to parent level).
*   **Collapse/Expand:** Items with children can be collapsed (▼) or expanded (▲).
*   **AJAX Save:** Order and hierarchy are saved via AJAX without page reload, updating both `menu_order` and `post_parent`.
*   **Max Depth:** Nesting is limited to 5 levels.

### 2.6. Dashboard Widget
*   Displays the 5 most recently updated manuals with links to the View Manuals page.

### 2.7. Settings Page
*   **Menu Customization:** Allows users to rename all admin menu labels (including the new Sort Order page).
*   **Important Notices:** A dedicated section provides permanent, translatable information regarding media file accessibility.

### 2.8. Security & Compliance
*   **Nonce Verification:** All links to the manual viewer and delete actions are protected with nonces.
*   **AJAX Nonce:** Sort order save uses `check_ajax_referer()`.
*   **Capability Checks:** `current_user_can()` is enforced on all pages and AJAX handlers.
*   **Data Sanitization:** All user-submitted data is sanitized with `absint()`, `sanitize_text_field()`, or `sanitize_key()`.
*   **Safe Redirects:** Delete actions use `wp_safe_redirect()`.
*   **Internationalization (i18n):** Fully translatable and compliant with WordPress.org standards.

---

## 3. Menu Structure

| Menu Item | Slug | Role |
|---|---|---|
| View Manuals | `manualdog_manual_index` | Read-only browsing |
| All Manuals | `manualdog_all_manuals` | Table view with edit/trash |
| Add New | `post-new.php?post_type=manualdog_manual` | Create new manual |
| Sort Order | `manualdog_sort` | Drag-and-drop reorder + nesting |
| Settings | `manualdog_settings` | Menu labels + notices |
| Manual Viewer | `manualdog_manual_viewer` (hidden) | Individual manual view |

---

## 4. File Structure

```
manualdog/
├── manualdog.php              # Main plugin file
├── uninstall.php              # Cleanup on uninstallation
├── README.txt                 # Readme for WordPress.org
├── README.md                  # Readme for GitHub
├── SPEC.md                    # This specification document
├── .distignore                # Files to exclude from release ZIP
│
├── assets/
│   ├── css/
│   │   └── manualdog-admin.css    # Admin styles (index, viewer, table, nestable2)
│   ├── img/
│   │   └── manualdog-logo.png
│   └── js/
│       ├── manualdog-viewer.js    # Sidebar toggle for viewer
│       ├── manualdog-alert.js     # Media library alert
│       ├── manualdog-sort.js      # nestable2 init + AJAX save
│       ├── nestable2.min.js       # nestable2 library (v1.6.0)
│       └── Sortable.min.js        # SortableJS (v1.15.0, unused legacy)
│
├── includes/
│   ├── admin-pages.php        # Menu registration + all page renderers
│   ├── dashboard.php          # Dashboard widget
│   ├── enqueue.php            # Script/style enqueue logic
│   ├── post-types.php         # Custom post type registration
│   └── sort.php               # AJAX handler for sort order save
│
└── languages/
    ├── manualdog.pot
    ├── manualdog-ja.po
    └── manualdog-ja.mo
```

---

## 5. Architectural Decisions Log

*   **Media File Alert:** Initial attempts with dynamic JavaScript alerts proved unreliable due to Gutenberg conflicts. The final, robust solution is a **permanent, static notice** on the settings page, ensuring 100% visibility.
*   **Title Truncation:** CSS's `text-overflow: ellipsis` was chosen over PHP character limiting for its multi-language-friendly, visual-based approach.
*   **Pager Logic:** The pager correctly navigates the hierarchy by first building a complete tree, then flattening it into a sorted linear array to determine the correct previous/next manual.
*   **Sort/Nest Library Choice (v1.1.0):** nestable2 was chosen over SortableJS because it natively supports drag-to-nest (parent-child hierarchy changes). SortableJS only handles flat list reordering.
*   **Separated Views (v1.1.0):** "View Manuals" (read-only) and "All Manuals" (management) were intentionally separated so that clients/editors see a clean browsing UI, while admins have a full management table.
*   **Sort as Dedicated Page (v1.1.0):** Sorting was moved to its own page (`manualdog_sort`) rather than inline on All Manuals, to keep each page focused and avoid complex mode-switching UI.

---

## 6. Future Roadmap

### 6.1. Free Version Enhancements (v1.2+)
*   [ ] **Search Functionality:** Add a basic search bar to the View Manuals page.
*   [ ] **Bulk Actions:** Add bulk trash/restore on the All Manuals page.

### 6.2. ManualDog Pro (Paid Version) - Conception
*   [ ] **Media File Security:** Implement a PHP-based file delivery script to prevent direct URL access.
*   [ ] **Advanced Access Control:** Create custom capabilities to restrict manual access per-user or per-role.
*   [ ] **Custom Branding / White Labeling:** Allow users to replace the ManualDog logo with their own.
*   [ ] **PDF Export:** Allow users to download manuals as a single PDF document.
*   [ ] **Payment & Licensing:** Research and integrate `Freemius` for handling payments, licensing, and updates.
