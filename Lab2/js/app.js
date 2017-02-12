/**
 * Created by matheusbmleite on 09/02/17.
 */

//use jQuery for a Delete confirmation pop-up
$('.confirmation').on('click', function() {
    return confirm('Are you sure you want to delete this item?');
})