# Google Sheet Live Dashboard

![Last Commit](https://img.shields.io/github/last-commit/Siphon880gh/google-sheet-dashboard/main)
<a target="_blank" href="https://github.com/Siphon880gh" rel="nofollow"><img src="https://img.shields.io/badge/GitHub--blue?style=social&logo=GitHub" alt="Github" data-canonical-src="https://img.shields.io/badge/GitHub--blue?style=social&logo=GitHub" style="max-width:8.5ch;"></a>
<a target="_blank" href="https://www.linkedin.com/in/weng-fung/" rel="nofollow"><img src="https://img.shields.io/badge/LinkedIn-blue?style=flat&logo=linkedin&labelColor=blue" alt="Linked-In" data-canonical-src="https://img.shields.io/badge/LinkedIn-blue?style=flat&amp;logo=linkedin&amp;labelColor=blue" style="max-width:10ch;"></a>
<a target="_blank" href="https://www.youtube.com/@WayneTeachesCode/" rel="nofollow"><img src="https://img.shields.io/badge/Youtube-red?style=flat&logo=youtube&labelColor=red" alt="Youtube" data-canonical-src="https://img.shields.io/badge/Youtube-red?style=flat&amp;logo=youtube&amp;labelColor=red" style="max-width:10ch;"></a>

## :page_facing_up: Description:
By Weng Fei Fung. Connect your Google Sheet to a live dashboard that has tables and charts. This frees you up to be able to extend other analytic tools on the same dashboard.

## :open_file_folder: Table of Contents:
---
- [Description](#page_facing_up-description)
- [Screenshots](#camera-screenshots)
- [Live Demo](#computer-live-demo)
- [Installation](#minidisc-installation)
- [Usage](#runner-usage)
- [Future Version](#crystal_ball-future-version)
---

## :camera: Screenshots:
![image](README-assets/dashboard.png)


## :computer: Live Demo:
<a href="https://wengindustry.com/tools/fintest/fintest/" target="_blank">Check it out</a>

## :minidisc: Installation:
Make sure you've setup a service account file, eg. serviceaccount.json:

```
{
  "type": "service_account",
  "project_id": "..",
  "private_key_id": "..",
  "private_key": "-----BEGIN PRIVATE KEY-----\n...
  \n-----END PRIVATE KEY-----\n",
  "client_email": "..@...iam.gserviceaccount.com",
  "client_id": "..",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/.."
}
```

service-account.json is a file you obtain from Google Cloud Platform after enabling the Google Sheet API and Service Account as an authentication method.

Make sure to share the google sheet to the service account's email address with full editor access. You do not have to own the spreadsheet (you can share to the service account's email as a full editor at your friend's spreadsheet when you are already an editor).

Finally, you may need to edit code: index.php's "creds" key is where you place the file path to the service account file.

It's recommended you keep the service account file outside the app folder for security reasons.

## :runner: Usage:
Run index.php on a PHP apache server. 


## :crystal_ball: Future version
- Resizable modals, more charting types, real-time intraday trading