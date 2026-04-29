# <img src="https://user-images.githubusercontent.com/1668339/72398593-cb0d1900-3786-11ea-863c-418ff8d48f43.png" style="height:1.0em; margin-right: 0.1em;" /><span style="position:relative; top:-0.1em;left:0.2em;">The "ONEPIECE Framework" is insanely great!!</span>

![License](https://img.shields.io/badge/license-Apache--2.0-black)
![PHP](https://img.shields.io/badge/PHP-8.x-black)

<p>
<img src="https://www.php.net/images/php8/logo_php8.svg"   alt="php8"   height="22"/>　
<img src="https://www.php.net/images/php8/logo_php8_1.svg" alt="php8.1" height="22"/>　
<img src="https://www.php.net/images/php8/logo_php8_2.svg" alt="php8.2" height="22"/>　
<img src="https://www.php.net/images/php8/logo_php8_3.svg" alt="php8.3" height="22"/>　
<img src="https://www.php.net/images/php8/logo_php8_4.svg" alt="php8.4" height="22"/>　
</p>

⭐ If you like this project, please give it a star!

## 📚 What Is ONEPIECE Framework?

The ONEPIECE Framework is a PHP framework focused on simple and Intuitive.

### ✨ ONEPIECE Framework explores a new approach

- Intuitive URL routing
- HTML pass-through architecture
- Controller-less routing
- UNIT modular structure
- Flexible layout system
- Built-in CI/CD tools

### 🧐 Policy and Philosophy

- Simple architecture
- Easy to understand
- Designed for developer productivity

### Why This Skeleton Exists

This repository is the application skeleton for building a site with the ONEPIECE Framework.
Please copy this repository to your own repository and use it.

## 🚀 Quick Start

 1. Clone the repository:
	```
	git clone https://github.com/onepiece-framework/op-skeleton-2030.git 2030
	```
 1. Move into the project directory:
	```
	cd 2030
	```
 1. Initialize git submodules:
	```
	php asset/init/submodules.php
	```
 1. Start the PHP built-in web server:
	```
	php -S localhost:2030 app.php
	```
 1. Open the following URL in your browser:
	```
	http://localhost:2030
	```

### 🔄 Future Updates

You can update the ONE PIECE Framework to the latest version using the following command.

```
php asset/init/update.php
```

## ⚡️ Quick Example

### CI/CD example

The ONEPIECE Framework has built-in CI/CD.

```
./cicd
```

⚠️ CAUTION ⚠️ Please change the "origin" to your own repository.

### HTML Pass-through example

 1. Create `example.html` and write:
	```
	<h1>Example</h1>
	<p><?= OP()->Timestamp() ?></p>
	<?php
	D( $_GET );
	?>
	```
 1. Open the following URL in your browser:
	```
	http://localhost:2030/example.html
	```

## 🗺️ Documentation Map

 - README.md
   Project overview, installation, and first steps.
 - CODEX.md
   Working rules for contributors and Codex operating on this repository.

# ❤️ Sponsor

If you like the **ONEPIECE Framework**, please consider sponsoring.

Your support helps maintain the project and improve documentation.

👉 https://github.com/sponsors/TomoakiNagahara

# 📜 License

Apache License 2.0

# 🙏 Apology

Let me offer a few apologies in advance.

## 📘 About English

We don’t aim for perfect or strictly correct English grammar.

In addition to the United Kingdom, countries such as the United States, Canada, and Australia also use English as an official language.
Furthermore, there are countries like India, Indonesia, Singapore, and the Philippines where English is widely used as a common language.

Apologies to those from other regions — we mainly follow American English.

We’re not native speakers, so as long as the meaning comes across clearly, that’s good enough for us.

## 🌍 UTF-8 Only

Officially, only UTF-8 is supported.
However, other encodings may also work, depending on PHP’s specifications.

## ❌ Microsoft Windows Products Not Supported

We do not officially support Microsoft Windows products.
This is to maintain clean and consistent source code.
However, Windows Subsystem for Linux (WSL) will likely work.
