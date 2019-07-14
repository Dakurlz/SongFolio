<?php

use Songfolio\Core\Helper;
?>

<div class="dashboard">
  <div class="dashboard-content">
    <div class="row">
      <div class=" col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
        <div class=" page stats-block ">
          <img src="<?= Helper::host() . "public/img/contents.svg"; ?>" />
          <div>
            <p> <?= $nb_articles ?? '0' ?> </p>
            <p>Articls</p>
          </div>
        </div>
      </div>
      <div class=" col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
        <div class="stats-block user">
          <img src="<?= Helper::host() . "public/img/users.svg"; ?>" />
          <div>
            <p><?= $nb_users ?? '0' ?></p>
            <p>Users</p>
          </div>
        </div>
      </div>
      <div class=" col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
        <div class="stats-block comment">
          <img src="<?= Helper::host() . "public/img/comments.svg"; ?>" />
          <div>
            <p><?= $nb_comments ?? '0' ?></p>
            <p>Commentaires</p>
          </div>
        </div>
      </div>
      <div class=" col-lg-3 col-md-6 col-sm-6 col-xs-6 col-12">
        <div class="stats-block daily-visit">
          <img src="<?php echo Helper::host() . "public/img/heart.svg"; ?>" />
          <div>
            <p><?= $nb_likes ?? '0' ?></p>
            <p>Likes</p>
          </div>
        </div>
      </div>
    </div>

    <br>

    <h3>Articles</h3>
    <hr>
    <br>

    <div class="dashboard-content__events ">
      <canvas id="graph-event"></canvas>
    </div>


    <h3>Categories</h3>
    <hr>
    <br>

    <div class="row dashboard-content__album">
      <div class="col-lg-4 col-md-4 col-12">
        <div class="graph-item">
          <canvas id="graph-category-article"></canvas>
        </div>
      </div>

      <div class=" col-lg-4 col-md-4 col-12">
        <div class="graph-item">
          <canvas id="graph-category-event"></canvas>
        </div>
      </div>

      <div class=" col-lg-4 col-md-4 col-12">
        <div class="graph-item">
          <canvas id="graph-category-album"></canvas>
        </div>
      </div>
    </div>

    <br>

    <h3>Albums</h3>
    <hr>
    <br>

    <div class="row dashboard-content__album">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="graph-item">
          <canvas id="graph-album-comment"></canvas>
        </div>
      </div>

      <div class=" col-lg-6 col-md-6 col-12">
        <div class="graph-item">
          <canvas id="graph-album-like"></canvas>
        </div>
      </div>
    </div>

    <br>
    <h3>Événements</h3>
    <hr>
    <br>

    <div class="row dashboard-content__album">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="graph-item">
          <canvas id="graph-event-comment"></canvas>
        </div>
      </div>

      <div class=" col-lg-6 col-md-6 col-12">
        <div class="graph-item">
          <canvas id="graph-event-like"></canvas>
        </div>
      </div>
    </div>

    <div class="row"></div>
  </div>
</div>

<script>
  /* SECTION EVENT GRAGRAPH */
  var ctxEvent = document.getElementById("graph-event").getContext("2d");
  var dataEvent = {
    labels: [<?php foreach ($articles_titles as $art) {
                echo '"' . $art . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($articles_comments as $comment) {
                echo '"' . $comment . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsEvent = {
    scales: {
      yAxes: [{
        ticks: {
          // utile pour que les valeurs min et max ne soient pas celles du dataset
          beginAtZero: true,
          suggestedMax: 15
        }
      }]
    },
    layout: {
      padding: {
        left: 50,
        right: 0,
        top: 20,
        bottom: 20
      }
    },
    title: {
      display: true,
      text: "Nombre de commentaire d’un article",
      fontSize: 20
    },
    legend: {
      display: false
    }
  };
  var myChart = new Chart(ctxEvent, {
    type: "bar",
    data: dataEvent,
    options: optionsEvent
  });

  /* SECTION ALBUM LIKE GRAPH*/
  var ctxAlbumLike = document
    .getElementById("graph-album-like")
    .getContext("2d");
  var dataAlbumLike = {
    labels: [<?php foreach ($albums_titles as $alb) {
                echo '"' . $alb . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($albums_likes as $like) {
                echo '"' . $like . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumLike = {
    title: {
      display: true,
      text: "Nombre de like d’un album"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumLike, {
    type: "pie",
    data: dataAlbumLike,
    options: optionsAlbumLike
  });

  /* SECTION ALBUM COMMENTS GRAPH*/
  var ctxAlbumComment = document
    .getElementById("graph-album-comment")
    .getContext("2d");
  var dataAlbumComment = {
    labels: [<?php foreach ($albums_titles as $alb) {
                echo '"' . $alb . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($albums_comments as $comment) {
                echo '"' . $comment . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumComment = {
    title: {
      display: true,
      text: "Nombre de commentaire d’un album"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumComment, {
    type: "pie",
    data: dataAlbumComment,
    options: optionsAlbumComment
  });

  //////////////////////////////////////////////////////////-


  /* SECTION EVENT LIKE GRAPH*/
  var ctxAlbumLike = document
    .getElementById("graph-event-like")
    .getContext("2d");
  var dataAlbumLike = {
    labels: [<?php foreach ($events_titles as $alb) {
                echo '"' . $alb . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($events_likes as $like) {
                echo '"' . $like . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumLike = {
    title: {
      display: true,
      text: "Nombre de like d’un événement"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumLike, {
    type: "pie",
    data: dataAlbumLike,
    options: optionsAlbumLike
  });

  /* SECTION EVENT COMMENTS GRAPH*/
  var ctxAlbumComment = document
    .getElementById("graph-event-comment")
    .getContext("2d");
  var dataAlbumComment = {
    labels: [<?php foreach ($events_titles as $alb) {
                echo '"' . $alb . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($events_comments as $comment) {
                echo '"' . $comment . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumComment = {
    title: {
      display: true,
      text: "Nombre de commentaire d’un événement"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumComment, {
    type: "pie",
    data: dataAlbumComment,
    options: optionsAlbumComment
  });

  /////////////////////////////////////////////////////

  var ctxAlbumComment = document
    .getElementById("graph-category-event")
    .getContext("2d");
  var dataAlbumComment = {
    labels: [<?php foreach ($category_event as $ev) {
                echo '"' . $ev['name'] . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($category_nb_event as $ev) {
                echo '"' . $ev . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumComment = {
    title: {
      display: true,
      text: "Nombre d'événement d'une catégorie"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumComment, {
    type: "pie",
    data: dataAlbumComment,
    options: optionsAlbumComment
  });


  var ctxAlbumComment = document
    .getElementById("graph-category-article")
    .getContext("2d");
  var dataAlbumComment = {
    labels: [<?php foreach ($category_article as $ev) {
                echo '"' . $ev['name'] . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($category_nb_article as $ev) {
                echo '"' . $ev . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumComment = {
    title: {
      display: true,
      text: "Nombre d'article d'une catégorie"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumComment, {
    type: "pie",
    data: dataAlbumComment,
    options: optionsAlbumComment
  });



  var ctxAlbumComment = document
    .getElementById("graph-category-album")
    .getContext("2d");
  var dataAlbumComment = {
    labels: [<?php foreach ($category_album as $ev) {
                echo '"' . $ev['name'] . '",';
              }

              ?>],
    datasets: [{
      label: "Nb de participants ",
      data: [<?php foreach ($category_nb_album as $ev) {
                echo '"' . $ev . '",';
              } ?>],
      backgroundColor: [
        "rgba(255, 99, 132, 0.5)",
        "rgba(54, 162, 235, 0.5)",
        "rgba(255, 206, 86, 0.5)",
        "rgba(75, 192, 192, 0.5)",
        "rgba(153, 102, 255, 0.5)",
        "rgba(255, 159, 64, 0.5)"
      ],
      borderColor: [
        "rgba(255,99,132,1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)"
      ],
      borderWidth: 1
    }]
  };

  var optionsAlbumComment = {
    title: {
      display: true,
      text: "Nombre d'album d'une catégorie"
    },
    cutoutPercentage: 40,
    animation: {
      animateRotate: true,
      animateScale: true
    }
  };
  var myChart = new Chart(ctxAlbumComment, {
    type: "pie",
    data: dataAlbumComment,
    options: optionsAlbumComment
  });

  
</script>