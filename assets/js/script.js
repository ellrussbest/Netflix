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
