# WIP: Banger-Simple

## Simple full-stack framework with PHP, built from scratch JSON-DB and Van.JS. It gets you covered from database to SSG without any Node.js, React or remote database provider. BANG! 🎉

- **💽 JSON Database: Every data you need is packed into AES256 password-protected .zip file containing your data in JSON format. Literally No SQL is in here. Table schema check and seeding is available!**

- **🧰 REST Friendly: Banger-Simple provides CRUD functions for accessing your JSON Database which you can use in /api directory.**

- **⚙️ Static Site Generator: Create dynamic routes with square brackets like in Next.JS (blog/[slug]/page.js) and run build.php. Then Banger-Simple provides full website in /prod directory.**

- **📚 Van.JS: We recommend to use provided Van.JS for full bangerness.**

## Installation

1. Run or open in your browser `init.php` file, you should see an example boilerplate.

## Configuration and basic usage

- Edit `config.json` to change your default app metadata.

## But why?

In my work I dealt with big legacy codebase and huge tech-debt. We couldn't use any Node.js packages. It lead to a reinventing the wheel type of situation, where I needed to build my own router for vanilla JavaScript with PHP elements to suit the needs. When we moved from that, the purist side of me wanted to create something fun that ressembled just that but taken to an extreme. 

⚠️ This is a hobby project, it cannot be used for production web apps due to limitations.