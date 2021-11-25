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
- [ ] Create model(s) in Eloquent to represent the data in the spreadsheet.
- [ ] Import said data from spreadsheet into a database. 
- [ ] View all records in the database. 
- [ ] Add Pagination to the view all records.
- [ ] Add ability to search by City
- [ ] Add ability to search all records. 
- [ ] Do the CRUD 
- [ ] Import the latest version of the file from the internet. 



## Why Laravel? Why not X, or Y, or Z?
Because it's my time, and I want to learn Laravel and React/Next.js etc. I needed to reference this sheet for something else that I'm doing and I thought it would better if this sheet could be a web app of it's own, so I'm building it. 

## NoCode solutions exist for this!!
Yes, I know. I've already imported this into Airtable, but I'm over the free plan. I would need to pay $10/month, and I wouldn't have a reason to learn Laravel.

## The Models 

If you look at the spreadsheet, you can see that there are **Providers** that provide **Programs** at different **Campuses**, so the database tries to reflect that. 

> One Provider can provide multiple Programs, so the relationship between Provders and Programs is one-to-many.

> One Provider may also have multiple Campuses, so the relationship here is also one-to-many. 

## Deployment Strategies

### Actions Secrets

**SSH_HOST**: The hostname or ip address we will deploy to 
**SSH_PRIVATE_KEY**: The key to use for deployment. Ideally the key that deploys to staging can't deploy to production. 
**SSH_USERNAME**: The username we deploy as. 
**DEPLOY_BRANCH**: branch we are deploying from


# Building the Database/Importing the records. 

I take the XLS file found on the website, and import it into a Google Sheet, and then download it as a CSV. 

Once I have the CSV, I can then read it using a [CSV reader](https://csv.thephpleague.com/9.0/) in PHP. 

# Using MongoDB instead of MySQL as of 11/24/2021 

While I was thinking through the process of importing the records from the spreadsheet, I realized that in 2021
this is probably a job for a document database like MongoDB. So, I refactored a lot of code to use MongoDB. 
