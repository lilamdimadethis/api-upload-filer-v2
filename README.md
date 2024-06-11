# File Upload API and HTML Site Demo

## Introduction

This project is a demonstration by **Lil Ami** to showcase how backends and file uploads work, specifically focusing on how to create a backend without using a database and instead using a directory for storing uploaded files.

## Live Demo

- HTML File Upload Site: [https://file-uploader-v1.glitch.me/](https://file-uploader-v1.glitch.me/)
- Secure HTML File Upload Site (v3): [https://file-uploader-v1.glitch.me/v3.html](https://file-uploader-v1.glitch.me/v3.html)
- Secure File Upload API (v3): [https://api-upload-filer-v2.glitch.me/v3.php](https://api-upload-filer-v2.glitch.me/v3.php)

## Description

This project consists of two main components:

1. **HTML File Upload Site**:
    - A simple HTML interface that allows users to upload files to the backend API.
    - Provides an easy way to test the file upload functionality.
    
2. **File Upload API**:
    - A PHP-based API that handles file uploads and saves them to a directory.
    - No database is used; files are stored directly in a directory.
    - **New in v3**: Secure file uploads with key-based access.

## What's New in v3

Version 3 (v3) includes enhanced security features for file uploads:

- **Secure File Storage**: Files are stored in a private directory (`priv-uploads`) and can only be accessed with a valid key.
- **Key Generation**: A unique key is generated for each uploaded file.
- **Access Control**: Files can only be accessed via a URL with the correct key. Invalid keys will result in an error message.
- **Improved Security**: Prevent unauthorized access to uploaded files by validating access keys.

### URL Structure Comparison

#### v2
- **File Directory**: You can see the file name.
- **Example URL**: [https://api-upload-filer-v2.glitch.me/upload/Opera%20Snapshot_2024-01-11_134603_www.google.com.png](https://api-upload-filer-v2.glitch.me/upload/Opera%20Snapshot_2024-01-11_134603_www.google.com.png) (no private key)

#### v3
- **No File Directory, No File Name**: Enhanced privacy as the file name and directory are not visible.
- **Added Private Key**: Each file access requires a unique private key for security.
- **New Encoding and Decoding**: Security enhancements with improved encoding and decoding mechanisms.
- **Generated Keys Stored in a File**: All generated keys are securely stored in a file.
- **Example URL**: [https://api-upload-filer-v2.glitch.me/v3.php?file=8e92e9af9eacbaa30b03315dc4d85724e61bda36.png&key=268cff54f0f45b49018cb4609590d4b0](https://api-upload-filer-v2.glitch.me/v3.php?file=8e92e9af9eacbaa30b03315dc4d85724e61bda36.png&key=268cff54f0f45b49018cb4609590d4b0)


### Important Note

![Warning](https://via.placeholder.com/15/f03c15/000000?text=+) **A BIG PROBLEM WITH UPLOADING DATA TO A DIRECTORY IS THAT THE DIRECTORY IS PUBLIC AND ANYONE CAN SEE IT. DO NOT PUT PRIVATE DATA THERE.**

## Usage

### HTML File Upload Site

1. Go to [https://file-uploader-v1.glitch.me/v3.html](https://file-uploader-v1.glitch.me/v3.html).
2. Use the form to select and upload a file.
3. The response will display the URL to the uploaded file with a secure key.

### Secure File Upload API

1. Make a POST request to the API endpoint: [https://api-upload-filer-v2.glitch.me/v3.php](https://api-upload-filer-v2.glitch.me/v3.php).
2. The file should be sent as form data with the key `file`.
3. The API will return a JSON response with the URL to the uploaded file if successful.

Example using `curl`:

```sh
curl -X POST -F "file=@/path/to/your/file.ext" https://api-upload-filer-v2.glitch.me/v3.php
