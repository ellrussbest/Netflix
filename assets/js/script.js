// `scrollTop()` function is used within a `scroll` event handler to get the current vertical position 
// of the scroll bar whenever the user scrolls the page.
$(document).scroll(() => {

  // this function basically checks whether the position of the scroll has exceeded the height of 
  // the div with the class .topBar
  // and when this happens we toggle the scrolled class depending on whether the conditon is true or false
  let isScrolled = $(this).scrollTop() > $(".topBar").height();
  $(".topBar").toggleClass("scrolled", isScrolled);
})


function volumeToggle(button) {
  var muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);

  $(button).find("i").toggleClass("fa-volume-xmark");
  $(button).find("i").toggleClass("fa-volume-high");
}

function previewEnded() {
  // toggle is used to toggle either hidden or show values of the element
  // if the element is on hidden, it will be toggled to show
  // and if it is on show then it will be toggled to hidden
  $(".previewVideo").toggle();
  $(".previewImage").toggle();
}

function goBack() {
  window.history.back();
}

function startHideTimer() {
  let timeout = null;
  $(document).on("mousemove", () => {
    clearTimeout(timeout);
    $(".watchNav").fadeIn();

    timeout = setTimeout(() => {
      $(".watchNav").fadeOut();
    }, 2000);
  });
}

function initVideo(videoId, username) {
  startHideTimer();
  setStartTime(videoId, username);
  updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
  addDuration(videoId, username);

  let timer;

  $("video")
    .on("playing", (event) => {
      window.clearInterval(timer);
      timer = window.setInterval(() => {
        updateProgress(videoId, username, event.target.currentTime);
      }, 3000);
    })
    .on("ended", () => {
      setFinished(videoId, username);
      window.clearInterval(timer);
    });
}

function addDuration(videoId, username) {
  $.post(
    "ajax/addDuration.php",
    {
      videoId,
      username,
    },
    (data) => {
      if (data !== null && data !== "") alert(data);
    }
  );
}

function updateProgress(videoId, username, progress) {
  $.post(
    "ajax/updateDuration.php",
    {
      videoId,
      username,
      progress,
    },
    (data) => {
      if (data !== null && data !== "") alert(data);
    }
  );
}

function setFinished(videoId, username) {
  $.post(
    "ajax/setFinished.php",
    {
      videoId,
      username,
    },
    (data) => {
      if (data !== null && data !== "") alert(data);
    }
  );
}

function setStartTime(videoId, username) {
  $.post(
    "ajax/getProgress.php",
    {
      videoId,
      username,
    },
    (data) => {
      if (isNaN(data)) {
        alert(data);
        return;
      }

      $("video").on("canplay", (event) => {
        // this.currentTime = data;
        event.target.currentTime = data;
        $("video").off("canplay");
      });
    }
  );
}

function restartVideo() {
  $("video")[0].currentTime = 0;
  $("video")[0].play();
  $(".upNext").fadeOut();
}

function watchVideo(videoId) {
  window.location.href = "watch.php?id=" + videoId;
}

function showUpNext() {
  $(".upNext").fadeIn();
}