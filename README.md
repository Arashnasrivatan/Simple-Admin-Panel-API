# Admin Panel API 🚀✨

Explore the features of our PHP-based Admin Panel API 🛠️📊

## Features 🌟
- 🔐 **Secure Authentication**: Ensuring your data is safe with robust authentication methods.
- 📊 **Data Management**: Easily manage content, users, and settings.

## Getting Started 🚀

To get started with the API, clone the repository and change the **restapi/crud/** in helper.php on line 56 With your own url 💡

use the postman file in repository 💎

## 📋 API Routes

### Authentication
- **🔐 Login**
  - `POST /v1/login` - Authenticate Admin (Users cant login).
  - **🔐 register**
  - `POST /v1/register` - Register User.

### 👥 Users
- **📜 List Users**
  - `GET /v1/users` - Retrieve all users. _(Requires admin)_
- **🔍 View User**
  - `GET /v1/users/{id}` - Retrieve a specific user by ID. _(Requires admin)_
- **➕ Add User**
  - `POST /v1/users` - Create a new user. _(Requires admin)_
- **🛠️ Update User**
  - `PUT /v1/users/{id}` - Update an existing user by ID. _(Requires admin)_
- **🗑️ Delete User**
  - `DELETE /v1/users/{id}` - Delete a user by ID. _(Requires admin)_
  - **📊 make User Admin**
  - `PUT /v1/users/makeadmin/{id}` - admin a user by ID. _(Requires admin)_

### 🖼️ Gallery
- **📜 List Galleries**
  - `GET /v1/gallery` - Retrieve all gallery items. _(Requires admin)_
- **🔍 View Gallery Item**
  - `GET /v1/gallery/{id}` - Retrieve a specific gallery item by ID. _(Requires admin)_
- **➕ Add Gallery Item**
  - `POST /v1/gallery` - Create a new gallery item. _(Requires admin)_
- **🛠️ Update Gallery Item**
  - `PUT /v1/gallery/{id}` - Update an existing gallery item by ID. _(Requires admin)_
- **🗑️ Delete Gallery Item**
  - `DELETE /v1/gallery/{id}` - Delete a gallery item by ID. _(Requires admin)_

### 📝 Posts
- **📜 List Posts**
  - `GET /v1/posts` - Retrieve all posts. _(Requires admin)_
- **🔍 View Post**
  - `GET /v1/posts/{id}` - Retrieve a specific post by ID. _(Requires admin)_
- **➕ Add Post**
  - `POST /v1/posts` - Create a new post. _(Requires admin)_
- **🛠️ Update Post**
  - `PUT /v1/posts/{id}` - Update an existing post by ID. _(Requires admin)_
- **🗑️ Delete Post**
  - `DELETE /v1/posts/{id}` - Delete a post by ID. _(Requires admin)_

### 💬 Comments
- **📜 List Comments**
  - `GET /v1/comments` - Retrieve all comments. _(Requires admin)_
- **🔍 View Comment**
  - `GET /v1/comments/{id}` - Retrieve a specific comment by ID. _(Requires admin)_
- **➕ Add Comment**
  - `POST /v1/comments` - Create a new comment. _(Requires admin)_
- **🛠️ Update Comment**
  - `PUT /v1/comments/{id}` - Update an existing comment by ID. _(Requires admin)_
- **🗑️ Delete Comment**
  - `DELETE /v1/comments/{id}` - Delete a comment by ID. _(Requires admin)_


## Developed by 👨‍💻

- [Arash_aio](https://t.me/arash_aio)


**Made with ❤️ by Arash Nasrivatan**
