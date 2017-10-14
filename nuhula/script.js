//auto click join group:
function getbutton() {
  var atagname = document.getElementsByTagName('a');
  var button = [];
  for (var i = 0; i < atagname.length; i++) {
    if (atagname[i].getAttribute('data-bt')) {
      button.push(atagname[i]);
    }
  }
  return button;
}

function clickbutton(waittime, timer, cancontinue, j, buttontoclick) {

  if (timer == 0) {
    if (buttontoclick.length == j + 1 || buttontoclick == '') {
      cancontinue = false;
    } else {
      buttontoclick[j].click();
      console.log('đã click ' + buttontoclick[j]);
      j++;
      console.log('còn lại ' + (buttontoclick.length-j) + ' nút nữa');
      timer = waittime;
    }
  } else {
    console.log(timer + ' giây nữa');
    timer--;
  }

  if (cancontinue) {
    setTimeout(function(){clickbutton(waittime, timer, cancontinue, j, buttontoclick);}, 1000);
  } else {
    startclick();
  }
}

function startclick() {
  var waittime = 30;
  var timer = waittime;
  var cancontinue = true;
  var j = 0;

  var buttontoclick = getbutton();
  console.log('có tất cả ' + buttontoclick.length + ' nút');
  clickbutton(waittime, timer, cancontinue, j, buttontoclick);
}

startclick();

//get group id:
var groupid = '';
var atag = document.getElementsByTagName('a');
for (var i = 0; i < atag.length; i++) {
  if (atag[i].getAttribute('href')) {
    if (atag[i].getAttribute('href').substring(0,2) == '/g') {
      if (atag[i].getAttribute('data-hovercard')) {
        var hvc = atag[i].getAttribute('data-hovercard');
        groupid += hvc.substring(hvc.lastIndexOf('=') + 1);
        groupid += ';'
      }
    }
  }
}
console.log(groupid);

//get timeline photos and caps:
function getpho_cap(i, imgtag) {
  console.log(imgtag.length - i);
  if (imgtag[i].getAttribute('class') == '_pq3 img') {
    var imgtag_style = imgtag[i].getAttribute('style');
    var photo_url = imgtag_style.substring(imgtag_style.lastIndexOf('(') + 1, imgtag_style.lastIndexOf(')'));
    console.log(photo_url);
    imgtag[i].click();

    setTimeout(function() {
      var spantag = document.getElementsByTagName('span');
      for (var j = 0; j < spantag.length; j++) {
        if (spantag[j].getAttribute('class') == 'hasCaption') {
          var photo_caption = spantag[j].innerHTML.substring(0, spantag[j].innerHTML.indexOf('<span')).replace(/<\w*>/g,'')
          console.log(photo_caption);
        }
      }
    }, 100);

    i++;
    setTimeout(function(){getpho_cap(i, imgtag);}, 3000);
  } else {
    i++;
    getpho_cap(i, imgtag);
    }
}

var i = 0;
var imgtag = document.getElementsByTagName('img');
getpho_cap(i, imgtag);


//temp: google sheet url:
var datatolog = '';
var atag = document.getElementsByTagName('a');
for (var i = 0; i< i.length; i++) {
  if (atag[i].getAttribute('class') == 'waffle-hyperlink-tooltip-link') {
    datatolog += atag[i].getAttribute('href') + ';';
  }

}
console.log(datatolog);
