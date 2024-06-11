# File Upload API and HTML Site Demo

## Introduction

This project is a demonstration by **Lil Ami** to showcase how backends and file uploads work, specifically focusing on how to create a backend without using a database and instead using a directory for storing uploaded files.

## Live Demo

- HTML File Upload Site: [https://file-uploader-v1.glitch.me/](https://file-uploader-v1.glitch.me/)
- File Upload API: [https://api-upload-filer-v2.glitch.me/](https://api-upload-filer-v2.glitch.me/)

## Description

This project consists of two main components:

1. **HTML File Upload Site**:
    - A simple HTML interface that allows users to upload files to the backend API.
    - Provides an easy way to test the file upload functionality.
    
2. **File Upload API**:
    - A PHP-based API that handles file uploads and saves them to a directory.
    - No database is used; files are stored directly in a directory.

### Important Note

![Warning](https://via.placeholder.com/15/f03c15/000000?text=+) **A BIG PROBLEM WITH UPLOADING DATA TO A DIRECTORY IS THAT THE DIRECTORY IS PUBLIC AND ANYONE CAN SEE IT. DO NOT PUT PRIVATE DATA THERE.**

## Usage

### HTML File Upload Site

1. Go to [https://file-uploader-v1.glitch.me/](https://file-uploader-v1.glitch.me/).
2. Use the form to select and upload a file.
3. The response will display the URL to the uploaded file.

### File Upload API

1. Make a POST request to the API endpoint: [https://api-upload-filer-v2.glitch.me/index.php](https://api-upload-filer-v2.glitch.me/index.php).
2. The file should be sent as form data with the key `file`.
3. The API will return a JSON response with the URL to the uploaded file if successful.

Example using `curl`:

```sh
curl -X POST -F "file=@/path/to/your/file.ext" https://api-upload-filer-v2.glitch.me/index.php
