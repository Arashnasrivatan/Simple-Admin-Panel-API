# Admin Panel API <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Travel%20and%20Places/Rocket.webp" alt="Rocket" width="25" height="25" /><img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Activity/Sparkles.webp" alt="Sparkles" width="25" height="25" />

Explore the features of our PHP-based Admin Panel API <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Toolbox.webp" alt="Toolbox" width="20" height="20" /><img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Bar%20Chart.webp" alt="Bar Chart" width="20" height="20" />

## Features <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Dizzy.webp" alt="Dizzy" width="25" height="25" />
- <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Locked%20With%20Key.webp" alt="Locked With Key" width="20" height="20" /> **Secure Authentication**: Ensuring your data is safe with robust authentication methods.
- <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Bar%20Chart.webp" alt="Bar Chart" width="20" height="20" /> **Data Management**: Easily manage content, users, and settings.

## Getting Started <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Travel%20and%20Places/Rocket.webp" alt="Rocket" width="20" height="20" />

To get started with the API, clone the repository and change the **restapi/crud/** in helper.php on line 56 With your own url <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Light%20Bulb.webp" alt="Light Bulb" width="20" height="20" />

use the postman file in repository <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Gem%20Stone.webp" alt="Gem Stone" width="20" height="20" />

## <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Memo.webp" alt="Memo" width="25" height="25" /> API Routes

### Authentication
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Locked%20With%20Key.webp" alt="Locked With Key" width="20" height="20" /> Login**
  - `POST /v1/login` - Authenticate Admin (Users cant login).
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Locked%20With%20Key.webp" alt="Locked With Key" width="20" height="20" /> register**
  - `POST /v1/register` - Register User.

### <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/People/Busts%20In%20Silhouette.webp" alt="Busts In Silhouette" width="20" height="20" /> Users
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/File%20Folder.webp" alt="File Folder" width="20" height="20" /> List Users**
  - `GET /v1/users` - Retrieve all users. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Magnifying%20Glass%20Tilted%20Left.webp" alt="Magnifying Glass Tilted Left" width="20" height="20" /> View User**
  - `GET /v1/users/{id}` - Retrieve a specific user by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Inbox%20Tray.webp" alt="Inbox Tray" width="20" height="20" /> Add User**
  - `POST /v1/users` - Create a new user. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Toolbox.webp" alt="Toolbox" width="20" height="20" /> Update User**
  - `PUT /v1/users/{id}` - Update an existing user by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Collision.webp" alt="Collision" width="20" height="20" /> Delete User**
  - `DELETE /v1/users/{id}` - Delete a user by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Bar%20Chart.webp" alt="Bar Chart" width="20" height="20" /> make User Admin**
  - `PUT /v1/users/makeadmin/{id}` - admin a user by ID. _(Requires admin)_

### <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/People/Family%20Man%20Woman%20Girl%20Boy.webp" alt="Family Man Woman Girl Boy" width="22" height="22" /> Gallery
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/File%20Folder.webp" alt="File Folder" width="20" height="20" /> List Galleries**
  - `GET /v1/gallery` - Retrieve all gallery items. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Magnifying%20Glass%20Tilted%20Left.webp" alt="Magnifying Glass Tilted Left" width="20" height="20" /> View Gallery Item**
  - `GET /v1/gallery/{id}` - Retrieve a specific gallery item by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Inbox%20Tray.webp" alt="Inbox Tray" width="20" height="20" /> Add Gallery Item**
  - `POST /v1/gallery` - Create a new gallery item. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Toolbox.webp" alt="Toolbox" width="20" height="20" /> Update Gallery Item**
  - `PUT /v1/gallery/{id}` - Update an existing gallery item by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Collision.webp" alt="Collision" width="20" height="20" /> Delete Gallery Item**
  - `DELETE /v1/gallery/{id}` - Delete a gallery item by ID. _(Requires admin)_

### <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Travel%20and%20Places/Camping.webp" alt="Camping" width="25" height="25" /> Posts
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/File%20Folder.webp" alt="File Folder" width="20" height="20" /> List Posts**
  - `GET /v1/posts` - Retrieve all posts. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Magnifying%20Glass%20Tilted%20Left.webp" alt="Magnifying Glass Tilted Left" width="20" height="20" /> View Post**
  - `GET /v1/posts/{id}` - Retrieve a specific post by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Inbox%20Tray.webp" alt="Inbox Tray" width="20" height="20" /> Add Post**
  - `POST /v1/posts` - Create a new post. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Toolbox.webp" alt="Toolbox" width="20" height="20" /> Update Post**
  - `PUT /v1/posts/{id}` - Update an existing post by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Collision.webp" alt="Collision" width="20" height="20" /> Delete Post**
  - `DELETE /v1/posts/{id}` - Delete a post by ID. _(Requires admin)_

### <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Speech%20Balloon.webp" alt="Speech Balloon" width="25" height="25" /> Comments
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/File%20Folder.webp" alt="File Folder" width="20" height="20" /> List Comments**
  - `GET /v1/comments` - Retrieve all comments. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Magnifying%20Glass%20Tilted%20Left.webp" alt="Magnifying Glass Tilted Left" width="20" height="20" /> View Comment**
  - `GET /v1/comments/{id}` - Retrieve a specific comment by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Inbox%20Tray.webp" alt="Inbox Tray" width="20" height="20" /> Add Comment**
  - `POST /v1/comments` - Create a new comment. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Objects/Toolbox.webp" alt="Toolbox" width="20" height="20" /> Update Comment**
  - `PUT /v1/comments/{id}` - Update an existing comment by ID. _(Requires admin)_
- **<img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Collision.webp" alt="Collision" width="20" height="20" /> Delete Comment**
  - `DELETE /v1/comments/{id}` - Delete a comment by ID. _(Requires admin)_


## Developed by <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/People/Man%20Technologist.webp" alt="Man Technologist" width="25" height="25" />

- [Arash_aio](https://t.me/arash_aio) <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Check%20Mark%20Button.webp" alt="Check Mark Button" width="20" height="20" />


**Made with <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Telegram-Animated-Emojis/main/Symbols/Heart%20On%20Fire.webp" alt="Heart On Fire" width="25" height="25" /> by Arash Nasrivatan**
