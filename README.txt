=== Manual Dog ===

Contributors: espicurio
Tags: manual, guide, documentation, admin, internal
Requires at least: 5.2
Tested up to: 6.9
Stable tag: 1.1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to create and manage manuals that are only visible to authorized users within the admin area.

== Description ==

**日本語のユーザー様へ:**

「マニュアル作成に、無駄なリソースをかけていませんか？」

ウェブサイトの納品時、クライアントに渡す操作マニュアル。見積もりでは「おまけ」扱いだったはずなのに、気づけば膨大な時間と労力を消費している…そんな経験はありませんか？

PDFで作ったマニュアルは、納品後に情報が古くなり、更新も面倒。どこに保存したか分からなくなることもしばしばです。

`Manual Dog`は、そんなウェブ制作者の「隠れたコスト」を解決するために生まれました。

マニュアルの作成・更新・閲覧、そして**並び替えも入れ子も**、すべてWordPressの管理画面内だけで完結します。

**主な機能:**

* **マニュアル閲覧** — モダンな2カラムレイアウトで、クライアントが快適にマニュアルを閲覧できます。
* **マニュアル一覧** — タイトル・投稿者・日付を一覧表示。編集・削除もここから。
* **並び替え・入れ子設定** — ドラッグ＆ドロップで並び順を変更。右にずらすと子（入れ子）に、左にずらすと親階層に戻せます。追加プラグイン不要。
* **Gutenberg対応** — ブロックエディターでリッチなマニュアルを作成できます。
* **メニュー名カスタマイズ** — 管理画面のメニュー名を自由に変更できます。

---

**For English speakers:**

Manual Dog is a WordPress plugin that lets you create, manage, and display internal manuals directly within the WordPress admin area — perfect for client handoffs, internal documentation, and team guides.

**Key Features:**

* **Manual Viewer** — A clean, two-column reading interface for an immersive experience.
* **All Manuals** — Table view with title, author, date, edit, and trash actions.
* **Drag & Drop Sorting with Nesting** — Reorder manuals by dragging. Drag right to nest (make a child), drag left to un-nest. No extra plugins required.
* **Gutenberg Ready** — Create rich content using the block editor.
* **Menu Label Customization** — Rename all admin menu labels to fit your workflow.

Manual Dog keeps your documentation alive inside the WordPress dashboard — always up-to-date, always within reach.

== Installation ==

1. Upload the `manualdog` folder to the `/wp-content/plugins/` directory via FTP, or upload the ZIP file through the WordPress admin panel (`Plugins` > `Add New`).
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. A "Manuals" menu will be added to your admin sidebar. Start creating!

== Frequently Asked Questions ==

= Are the media files (images, PDFs) protected? =

In this free version, no. Media files uploaded to a manual are still publicly accessible if someone knows their direct URL. This is a standard WordPress behavior. The plugin shows a reminder about this on the settings page. Full media protection is a feature planned for a future premium version.

= Can I customize the appearance? =

The settings page allows you to rename the admin menus. For deeper visual customizations, you would need to use custom CSS.

= Can I reorder manuals? =

Yes! As of v1.1.0, you can use the built-in "Sort Order" page to drag and drop manuals into any order. You can also nest manuals by dragging them to the right to create parent-child relationships.

= Can I reorder manuals? = （日本語）

はい！v1.1.0より、「並び順設定」ページでマニュアルをドラッグ＆ドロップで並び替えられます。右にドラッグすると入れ子（親子関係）を作ることもできます。

== Screenshots ==

1. The modern, two-column manual viewer interface, providing an immersive reading experience. / 閲覧に集中できる、モダンな2カラムのビューワー画面です。
2. The All Manuals page showing a clean table with title, author, date, and actions. / タイトル・投稿者・日付・操作を一覧できる、マニュアル一覧ページです。
3. The Sort Order page with drag-and-drop reordering and nesting support. / ドラッグ＆ドロップで並び替えと入れ子設定ができる、並び順設定ページです。
4. The easy-to-use settings page for renaming menus. / 管理メニュー名を自由に変更できる、シンプルな設定画面です。

== Changelog ==

= 1.1.0 =
* New: Added "All Manuals" page — a clean table view with title, author, date, edit, and trash actions.
* New: Added "Sort Order" page — drag-and-drop reordering with nested (parent-child) support powered by nestable2.
* Improved: Separated manual browsing (View Manuals) from manual management (All Manuals) for a cleaner workflow.
* Improved: Removed the "Post Types Order" plugin recommendation from the Settings page, as sorting is now built-in.

= 1.0.1 =
* Security Fix: Added nonce verification and enhanced data sanitization based on feedback from the WordPress.org review team.
* Updated "Tested up to" version for compatibility.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.0 =
New feature update. Adds built-in drag-and-drop sorting and a redesigned manual management page. No database changes — all existing manuals are preserved.

= 1.0.1 =
Security and compatibility update. Recommended for all users.

= 1.0.0 =
This is the first version of the plugin. Enjoy!
