## Quickie PHP to send contact/order details to Telegram

#### tg_bot_send_message.php
- Gets `client_name` and `client_tel` from html/js form
- Parses `bot.ini` file for Telegram chat credentials
- Uses `blacklist.txt` to filter out blacklisted numbers
- Sends message to Telegram chat using Token and ChatId

#### blacklist.html
- a form to append phone number to `blacklist.txt`
- uses `add_blacklist.php`
