/* 
This is a class to keep track of what objects are and aren't selected in a page,
as well as the tags that selected them.
 */


function gallery_items() {
    this.title = "I am the title!";
    // This holds the status of an item, labelled by the checksum
    this.images = new Array();
    // This holds the tags currently in play, may get more advanced
    this.tags = new Array();

    this.add_item = add_item;
    this.add_post = add_post;
    this.toggle_item = toggle_item;
    this.print_all_items = print_all_items;
    this.submit_tags = submit_tags;
    this.submit_items = submit_items;
}

// This adds a new item to the list
function add_item(add_me) {
    //success(add_me);
    this.images[add_me] = true;
}

function add_post(post_data) {

}

function toggle_item(toggle_me) {
    if(this.images[toggle_me]) {
        this.images[toggle_me] = false;
    } else {
        this.images[toggle_me] = true;
    }
}
function print_all_items() {
    for(var i in this.images) {
        echo(this.images[i]);
    }
}

function get_tags() {
    return this.tags;
}

function submit_tags() {
}

function submit_items() {
}
