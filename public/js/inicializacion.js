var elem = document.querySelector('.fixed-action-btn');
var instance = M.FloatingActionButton.init(elem, {
    direction: 'left'
});
// Or with jQuery

$(document).ready(function () {
    $('.fixed-action-btn').floatingActionButton();
});

var elem = document.querySelector('.collapsible');
var instance = M.Collapsible.init(elem);

// Or with jQuery

$(document).ready(function () {
    $('.collapsible').collapsible();
});

var elem = document.querySelector('.modal');
var instance = M.Modal.init(elem);

  // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });