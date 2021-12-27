[![Laravel & PHP Linter](https://github.com/vidluther/twc-wioa-programs/actions/workflows/laravel.yml/badge.svg)](https://github.com/vidluther/twc-wioa-programs/actions/workflows/laravel.yml)
[![deploy](https://github.com/vidluther/twc-wioa-programs/actions/workflows/deploy.yml/badge.svg)](https://github.com/vidluther/twc-wioa-programs/actions/workflows/deploy.yml)
# TWC Workforce Innovation & Opportunity Act    

## WIO wha?
This is going to be a simple interface to the list of eligible training programs for TWC WIOA. 

The list is available on the [TWC Website as an Excel Spreadsheet](https://www.twc.texas.gov/files/partners/statewide-eligible-training-program-list-twc.xlsx) , this code just makes it searchable/filterable via a webform. 

## Roadmap 

Here's what I see as the steps to learning Laravel. 

- [x] Install and run Laravel Locally.
- [x] Change the default view to a nicer home page that explains what this project is.
- [x] Create model(s) in Eloquent to represent the data in the spreadsheet.
- [x] Import said data from spreadsheet into a database. 
- [x] View all records in the database. 
- [x] Add Pagination to the view all records.
- [x] View a record in detail 
- [x] Add ability to search by City
- [x] Add ability to search all records. 
- [ ] Do the CRUD 
- [x] Import the latest version of the file from the internet. 



## Why Laravel? Why not X, or Y, or Z?
Because it's my time, and I know PHP already, I figured I should get familiar with how the app would be built
using the latest/most popular PHP framework first, before I tried to do this again in Vue/Nuxt/Next/React/... etc.


### Actions Secrets

**SSH_HOST**: The hostname or ip address we will deploy to 
**SSH_PRIVATE_KEY**: The key to use for deployment. Ideally the key that deploys to staging can't deploy to production. 
**SSH_USERNAME**: The username we deploy as. 
**DEPLOY_BRANCH**: branch we are deploying from


# Building the Database/Importing the records. 

1. I take the XLS file found on the website, and import it into a Google Sheet, and then export/download it as a CSV. 
2. Run the command 
```bash
php artisan migrate:fresh --seed
```
3. If all goes well, there is no step 3. If something goes awry.. try to figure out why..


