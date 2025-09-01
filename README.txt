=== Manual Dog ===
Contributors: espicurio
Tags: manual, guide, documentation, admin, internal
Requires at least: 5.2
Tested up to: 6.8
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 5.2
Tested up to: 6.8

A WordPress plugin to create and manage manuals that are only visible to authorized users within the admin area.

== Description ==

**日本語のユーザー様へ:**

「マニュアル作成に、無駄なリソースをかけていませんか？」

ウェブサイトの納品時、クライアントに渡す操作マニュアル。
見積もりでは「おまけ」扱いだったはずなのに、気づけば膨大な時間と労力を消費している…そんな経験はありませんか？

PDFで作ったマニュアルは、納品後に情報が古くなり、更新も面倒。どこに保存したか分からなくなることもしばしばです。

`Manual Dog`は、そんなウェブ制作者の「隠れたコスト」を解決するために生まれました。

マニュアルの作成、更新、そして閲覧。そのすべてを、クライアントが日頃から慣れ親しんだWordPressの管理画面内だけで完結させましょう。
`Manual Dog`は、いつでも最新の情報を、必要な人のすぐそばに届けます。

---

**For English speakers:**
ManualDog is a simple and intuitive manual management plugin designed for use within the WordPress admin area. It allows you to create, organize, and display manuals exclusively for logged-in users, making it perfect for client handoffs, internal company guides, or user documentation.

== Installation ==

1.  Upload the `manualdog` folder to the `/wp-content/plugins/` directory via FTP, or upload the ZIP file through the WordPress admin panel (`Plugins` > `Add New`).
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  A "Manuals" menu will be added to your admin sidebar. Start creating!

== Frequently Asked Questions ==

= Are the media files (images, PDFs) protected? =

In this free version, no. Media files uploaded to a manual are still publicly accessible if someone knows their direct URL. This is a standard WordPress behavior. The plugin shows a reminder about this on the settings page. Full media protection is a feature planned for a future premium version.

= Can I customize the appearance? =

The settings page allows you to rename the admin menus. For deeper visual customizations, you would need to use custom CSS.

== Screenshots ==

1. The modern, two-column manual viewer interface, providing an immersive reading experience. / 閲覧に集中できる、モダンな2カラムのビューワー画面です。
2. The main index page listing all manuals hierarchically. / 全てのマニュアルを階層表示する、メインの一覧ページです。
3. The easy-to-use settings page for renaming menus. / 管理メニュー名を自由に変更できる、シンプルな設定画面です。
4. The important notice section on the settings page. / メディアファイルの注意喚起などが表示される、設定画面の注意書きエリアです。

== Changelog ==

= 1.0.1 =
* Security Fix: Added nonce verification and enhanced data sanitization based on feedback from the WordPress.org review team.
* Updated "Tested up to" version for compatibility.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.1 =
Security and compatibility update. Recommended for all users.

= 1.0.0 =
This is the first version of the plugin. Enjoy!