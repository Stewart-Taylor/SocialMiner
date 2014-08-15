var firstTime = false;

function getTweets() {
  var $container = $('#container');
    
  $container.masonry({
    itemSelector: '.item',
    columnWidth: 230,
    isFitWidth: true,
    isAnimated: !Modernizr.csstransitions
  });
      
  var ajaxError = function(){
    alert("error");
    $loadingItem.text('Could not load tweets :(');
  };

  if(!firstTime) { 
    $.getJSON('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=_richardgorman&callback=?')
      .error(ajaxError)
      .success(function(data) {

        firstTime = true;
        if (!data || !data.length)
        {
          ajaxError();
          return;
        }

        var items = [], item, tweet;
        
        for (var i = 0, len = data.length; i < len; i++) {
          tweet = data[i];

          if(tweet.entities.urls[0]) {
            item = '<div class="item">' +
                      '<img src="./images/thumbnails/goodfood.jpg" />' +
                      '<p>' + tweet.text + '</p>' +
                      '<span class="posted_by">' + 
                      '<span class="time_posted">2h</span>' + 
                      tweet.user.name + '</span>' +
                    '</div>';
            items.push(item);
          }
        }
        
        var $items = $(items.join(''));

        $items.imagesLoaded(function() {
            $container.prepend($items).masonry('reload');
        });       
    });
  }
}

$(function() {
  setInterval("getTweets();", 1000);
});

/*$(function(){    
    var $container = $('#container');
    
    $container.masonry({
      itemSelector: '.item',
      columnWidth: 230,
      isFitWidth: true,
      isAnimated: !Modernizr.csstransitions
    });
        
    var ajaxError = function(){
      $loadingItem.text('Could not load tweets :(');
    };
    
    $.getJSON('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=_richardgorman&count=100&callback=?')
      .error(ajaxError)
      .success(function(data) {     
        if (!data || !data.length)
        {
          ajaxError();
          return;
        }

        var items = [], item, tweet;
        
        for (var i = 0, len = data.length; i < len; i++)
        {
          tweet = data[i];

          if(tweet.entities.urls[0]) {
            item = '<div class="item">' +
                      '<img src="./images/thumbnails/goodfood.jpg" />' +
                      '<p>' + tweet.text + '</p>' +
                      '<span class="posted_by">' + 
                      '<span class="time_posted">2h</span>' + 
                      tweet.user.name + '</span>' +
                    '</div>';
            items.push(item);
          }
        }
        
        var $items = $(items.join(''));

        $items.imagesLoaded(function()
        {
            $container.prepend($items).masonry('reload');
        });       
      });  
  });*/