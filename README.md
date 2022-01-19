# Calculate products test task

# Install
copy .env file and configure your constants 
Just execute composer install 


## My thoughts
I did not write detailed comments on the code, only a description of the input and output data. Everything is very clear in the code. I would implement the cache manager differently.
For api, I made a fake class that gives data, but I also implemented a call to api

## For test
just execute \Tests\Feature\ShoppingCartTest::thisShouldCalculatePrice
