# OpenAPI Documentation

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md)

OpenAPI is the **menu / contract** for the SGM application's API. An "API" is the way that software talks to other software — the door other programs knock on to ask the app to do something (create a maintenance ticket, list equipment, check stock, generate a report, and so on).

The OpenAPI document describes, in one standard, machine-readable format, **every single thing that API can do**: each "door" (endpoint), what it expects you to send, what it will give back, and what security it requires. Because the format is a widely recognized standard, lots of tools can read it automatically — so other software and developers know *exactly* how to talk to the app without needing anyone to explain it to them by hand.

## How the documentation is generated

The contract isn't written by hand. Instead, the team adds short descriptions (called **OpenAPI attributes**) directly inside the application's source code — in a folder called `app/OpenApi` and on the HTTP controllers (the pieces of code that handle each request). When you run:

```bash
composer docs:generate
```

the tool scans that source code, reads every attribute and description it finds, and automatically produces two versions of the documentation — one as a `.json` file and one as a `.yaml` file. Both are written to:

- `storage/api-docs/api-docs.json`
- `storage/api-docs/api-docs.yaml`

These generated files are **build artifacts** — meaning they are results produced by a tool, not hand-maintained documents — so they are intentionally **not** saved into the version-control repository. You run the command to (re)create them whenever the code changes.

## How a non-technical person can view the documentation

You don't need to be a programmer to look at it. Laravel uses a tool called **Swagger UI**, which turns the raw OpenAPI file into a clean, interactive web page — like a nicely formatted table of contents instead of a wall of raw text.

This project exposes it at the URL path **`/docs/openapi`**, and access is protected so only **authorized administrators** can see it. When you open that page in a browser, you'll see:

- The **title and description** of the API ("Fault Management API") and who maintains it.
- A **list of everything the API can do**, organized into logical groups (such as Tickets, Users, Attachments, Analytics, and Stock).
- For each action, a **plain-English summary** and explanation of what it does.
- Expandable details showing the **inputs it expects** and the **outputs it returns**.
- Buttons to **try the requests right in the browser**, so you can click "Execute" and see a real response without writing any code.

So the OpenAPI documentation is essentially the "user manual for machines" — a complete, standard contract that is automatically generated from the code itself, safe and simple to browse for any authorized administrator in a browser.
