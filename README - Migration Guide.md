# Migration Guide

Project "dashboard-gsheet" under siphon880g@gmail.com
https://console.cloud.google.com/apis/dashboard?inv=1&invt=AbiN9w&project=sapient-magnet-132701

Service key file: sapient-magnet-132701-eb7763721187.json

Note: Google will disable your Google Sheet API from inactivity

Usually you have multiple dashboards, so you could have a (notice the plural "dashboard-gsheets/") `/apps/dashboard-gsheets/specific-dashboard`. That specific dashboard is the git repo `dashboard-gsheet`

The index.php contains the pointing to the service account file as well as the loading logic (title of tab, etc) and therefore has been gitignored - refer to `index.php.sample` for the template to follow when you create the `index.php`.

Number of levels up from inside the specific dashboard folder for the service accounts:
- 4x
- If it were interactively:
```
cd dashboard-gsheet
cd specific-dashboard
cd ../
cd ../
cd ../
cd ../
cd keys
```
- Your app will load the service account from `index.php`
- So the path could be 5x levels up: `/../../../../keys`

Make sure to run `composer install` to install the vendors/ and to run composer install on a non-root account (eg. `su otherUser`).