<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
  margin: 0;
  padding: 0;
  font-family: "Poppins", sans-serif;
}

.hero {
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(45deg, #a700ff, #4d19db);
  padding-left: 8%;
  padding-right: 8%;
  box-sizing: border-box;
  color: #fff;
  position: relative;
  z-index: 1;
  overflow: hidden;
}
nav {
  display: flex;
  align-items: center;
  padding: 30px 0;
}
.ncb {
  font-size: 3em;
}
.logo {
  width: 150px;
}
nav ul {
  flex: 1;
  text-align: right;
}
nav ul li {
  display: inline-block;
  list-style: none;
  margin: 0 15px;
}
a {
  text-decoration: none;
  color: #fff;
}
.btn {
  border: 2px solid #fff;
  padding: 6px 25px;
  border-radius: 30px;
  margin-left: 30px;
}
nav .btn:hover {
  background: #fff;
  color: #4d19db;
  font-weight: 500;
  transition: 0.1s;
}
.row {
  display: flex;
  flex-wrap: wrap;
  margin-top: 10%;
  justify-content: space-between;
}

.col-1 {
  flex-basis: 40%;
  min-width: 300px;
  margin-bottom: 30px;
  position: relative;
}
.col-2 {
  flex-basis: 55%;
  min-width: 300px;
  margin-bottom: 30px;
}
.col-1 img {
  width: 100%;
}
.col-2 h1 {
  font-size: 62px;
  font-weight: 600;
}
span {
  color: yellow;
}
.col-2 p {
  margin: 10px 0 50px;
  max-width: 580px;
}
.col-2 .btn {
  margin-left: 0;
  margin-right: 30px;
  background: #fff;
  color: #4d19db;
  font-weight: 500;
}
.col-2 .btn:hover {
  background: rgb(230, 234, 236);
  transition: 0.2s;
}
.elements {
  position: absolute;
  left: 0;
  top: 0;
  animation: move 2.5s linear infinite;
}
@keyframes move {
  0% {
    transform: translate(-15px, 0px);
  }
  50% {
    transform: translate(0px, -15px);
  }
  100% {
    transform: translate(-15px, 0px);
  }
}

.triangle1 {
  position: absolute;
  left: 50%;
  top: -180px;
  transform: translate(-50%);
  width: 400px;
  z-index: -1;
  opacity: 0.7;
}
.triangle2 {
  position: absolute;
  left: -50px;
  top: 50%;
  transform: translateY(-50%);
  width: 400px;
  z-index: -1;
  opacity: 0.7;
}
.circle {
  position: absolute;
  right: -180px;
  bottom: -300px;
  width: 500px;
  z-index: -1;
  opacity: 0.5;
}

    </style>
</head>
<body>
  <div class="hero">
    <img src="https://i.postimg.cc/4x12v2cB/triangle-top.png" class="triangle1">
    <img src="https://i.postimg.cc/WpQyskj6/triangle-left.png" class="triangle2">
    <img src="https://i.postimg.cc/MZc4kDkp/circle.png" class="circle">
    <nav>
      <h1 class="ncb">NCB IT</h1>
      <!-- <img src="images/ncbit.png" alt="" class="logo"> -->
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Portfolio</a></li>
        <li><a href="">Clients</a></li>
        <li><a href="">Pricing</a></li>
        <li><a href="">About Us</a></li>
      </ul>
      <a href="" class="btn">Get A Quote</a>
    </nav>
    <div class="row">
      <div class="col-1">
        <img src="https://i.postimg.cc/15wjX33x/man.png">
        <img src="https://i.postimg.cc/2SYXZN11/elements.png" class="elements">
      </div>
      <div class="col-2">
        <h1>Digital<br> <span>Marketing</span> Agency</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt suscipit maxime id at.</p>
        <a href="" class="btn">Learn More</a>
      </div>
    </div>
  </div>

</body>
</body>
</html>