## Quickie PHP script to send contact details to Telegram

#### tg_bot_send_message.php
- Gets `client_name` and `client_tel` from posted html/js form
- Uses `blacklist.txt` to filter out blacklisted phone numbers
- Parses `bot.ini` file for Telegram API chat credentials
- Sends message to Telegram chat using Token and ChatId

#### blacklist.html
- a form to append phone number to `blacklist.txt`
- uses `add_blacklist.php`
