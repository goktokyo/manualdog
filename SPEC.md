# ManualDog - Development Specification (v1.0.1)

**Last Updated:** 2025-07-14
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

## 2. Core Features (v1.0.1)

### 2.1. Custom Post Type: `manualdog_manual`
*   **Admin-Facing Only:** Content is not displayed on the front-end (`public: false`).
*   **Gutenberg Ready:** Fully compatible with the block editor.
*   **Hierarchical Structure:** Supports parent-child relationships (`hierarchical: true`).

### 2.2. Dedicated Manual Viewer
*   **Immersive UI:** A clean, two-column layout (navigation sidebar + content area).
*   **Responsive Design:** Fully responsive for desktop and mobile devices.
*   **Persistent Navigation:** A hierarchical navigation sidebar is always visible.

### 2.3. Hierarchical Pager
*   "Previous" and "Next" navigation links correctly follow the hierarchical structure.

### 2.4. Dashboard Widget
*   Displays the 5 most recently updated manuals.

### 2.5. Settings Page
*   **Menu Customization:** Allows users to rename all admin menu labels.
*   **Important Notices:** A dedicated section provides permanent, translatable information regarding media file accessibility and manual sorting.

### 2.6. Security & Compliance
*   **Nonce Verification:** All links to the manual viewer are protected with nonces.
*   **Data Sanitization:** All user-submitted data from the settings page is thoroughly sanitized.
*   **Internationalization (i18n):** Fully translatable and compliant with WordPress.org standards.

---

## 3. File Structure
manualdog/
├── manualdog.php # Main plugin file.
├── uninstall.php # Cleanup on uninstallation.
├── README.txt # Readme for WordPress.org.
├── README.md # Readme for GitHub.
├── SPEC.md # This specification document.
│
├── assets/
│ ├── css/
│ │ └── manualdog-admin.css
│ ├── img/
│ │ └── manualdog-logo.png
│ └── js/
│ └── manualdog-viewer.js
│
├── includes/
│ ├── admin-pages.php
│ ├── dashboard.php
│ ├── enqueue.php
│ └── post-types.php
│
└── languages/
├── manualdog.pot
└── manualdog-ja.po/mo


---

## 4. Architectural Decisions Log

*   **Media File Alert:** Initial attempts with dynamic JavaScript alerts proved unreliable due to Gutenberg conflicts. The final, robust solution is a **permanent, static notice** on the settings page, ensuring 100% visibility.
*   **Title Truncation:** CSS's `text-overflow: ellipsis` was chosen over PHP character limiting for its multi-language-friendly, visual-based approach.
*   **Pager Logic:** The pager correctly navigates the hierarchy by first building a complete tree, then flattening it into a sorted linear array to determine the correct previous/next manual.

---

## 5. Future Roadmap

### 5.1. Free Version Enhancements (v1.1+)
*   [ ] **Improve Manual List View:** Add last modified date and author to the index page.
*   [ ] **Search Functionality:** Add a basic search bar to the index page.

### 5.2. ManualDog Pro (Paid Version) - Conception
*   [ ] **Media File Security:** Implement a PHP-based file delivery script to prevent direct URL access.
*   [ ] **Advanced Access Control:** Create custom capabilities to restrict manual access per-user or per-role.
*   [ ] **Custom Branding / White Labeling:** Allow users to replace the ManualDog logo with their own.
*   [ ] **PDF Export:** Allow users to download manuals as a single PDF document.
*   [ ] **Payment & Licensing:** Research and integrate `Freemius` for handling payments, licensing, and updates.