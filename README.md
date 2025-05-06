# WP Post Expiry

**WP Post Expiry** is a lightweight WordPress plugin that allows you to set expiry dates for posts. Once the specified time is reached, the post will be automatically unpublished (set to draft).

---

## ✨ Features

- Set an expiry date for any post
- Automatic unpublishing of expired posts
- Hourly checks using WordPress cron
- Simple user interface in the post editor
- No impact on performance
- Clean and modular code

---

## 📦 Installation

1. Download the plugin ZIP or clone the repository.
2. Upload the folder to your `/wp-content/plugins/` directory.
3. Activate the plugin through the WordPress admin panel.
4. While editing a post, set the expiry date in the meta box provided.

---

## 🛠 Usage

- Navigate to any post.
- Set the expiry date using the calendar field in the meta box.
- The plugin will automatically unpublish the post at the set date and time.

---

## 🔄 How It Works

The plugin schedules a cron event that runs every hour. It checks for posts with expiry dates that have passed and sets their status to `draft`.

---

## 🧩 Developers

- Object-oriented structure
- Easy to extend and hook into
- Organized in `/includes/classes/` with autoload-ready patterns

---

## 📄 License

Licensed under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

## 👤 Author

Md Abdullah Al Fahad  
GitHub: [@mabf-fahad](https://github.com/mabf-fahad)

---

## 🙏 Contributions

Pull requests and issues are welcome!
