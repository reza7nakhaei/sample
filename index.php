<?php

require_once("./backend/db.php");

// سکشن اول
$infoResult = mysqli_execute_query($conn, "  SELECT title, description FROM sections LIMIT 1");

$servicesResult = mysqli_execute_query($conn, "SELECT title FROM services");
$projectsResult = mysqli_execute_query($conn, "SELECT * FROM projects");



$section = mysqli_fetch_assoc($infoResult);

?>



<meta content="width=device-width,initial-scale=1" name="viewport" />
<title>
  gohar hossein zadeh . dubai</title>
<link href="styles/output.css" rel="stylesheet" />
<link href="styles/style.css" rel="stylesheet" />
<link href="./img/favi.webp" rel="icon" type="image/x-icon" />
<link href="./font/Oswald-Light.woff" rel="preload" type="font/woff2" as="font" crossorigin="anonymous" />
<link href="./font/Oswald-Light.woff2" rel="preload" type="font/woff2" as="font" crossorigin="anonymous" />
<script src="./sections/global.js" type="module"></script>

<body class="uppercase bg-[#fcfcf3] font-oswald" data-section="home">
  <!--  سلام اول سایت -->
  <div id="splash">
    <p id="greeting"></p>
  </div>

  <!-- صفحه اول سایت  -->
  <div class="hidden bg-[#fcfcf3]" id="main-content">
    <section class="flex bg-[#fcfcf3] flex-col home-hero md:h-screen overflow-hidden w-full" id="home">
      <!-- بخش بالا -->
      <section>
        <section
          class="flex items-end pt-10 2xl:pt-28 2xl:px-56 basis-[30%] justify-end lg:pt-20 lg:px-28 md:pt-20 md:px-20 px-6 sm:pt-20 sm:px-10 w-full xl:pt-28 xl:px-32"
          id="hero">ّ

          <!-- بخش چپ حذف شد -->
          <div class="left-box hidden"></div>

          <div class="right-box hidden sm:inline-block">
            <a href="#contact" class="inline-block">
              <h4
                class="uppercase tracking-widest cursor-default font-light mb-1 md:mb-2 md:text-3xl select-none sm:text-2xl text-center text-xl">
                let.s make magic!
              </h4>
              <button class="w-full backgroundButton md:p-2 p-1 rounded-2xl text-white" id="myButton">
                <span
                  class="uppercase tracking-widest btnSpan font-extralight md:font-light md:text-2xl sm:text-xl text-base">Start
                  a Project</span>
              </button>
            </a>
          </div>

        </section>
      </section>


      <!-- بخش پایین -->
      <section class="flex w-full">

        <!-- بخش چپ پایین -->
        <section class="w-1/2 flex items-center justify-center" id="features">
          <div class="feature-section h-full flex flex-col items-center justify-center">

            <!-- بخش اول: کلمه CREATIVE -->
            <div class="flex sm:flex-col sm:items-start items-center justify-center space-y-1 tracking-tight">
              <p
                class="cursor-default select-none font-light md:text-2xl lg:text-3xl 2xl:text-4xl text-lg sm:text-xl whitespace-nowrap colored heading-1">
                <span class="letterColor">C</span>
                <span class="letterColor">R</span>
                <span class="letterColor">E</span>
                <span class="letterColor">A</span>
                <span class="letterColor">T</span>
                <span class="letterColor">I</span>
                <span class="letterColor">V</span>
                <span class="letterColor">E</span>
              </p>
            </div>

            <!-- بخش دوم: کلمه designer -->
            <div class="flex sm:flex-col sm:items-start items-center justify-center space-y-1 tracking-tight">
              <p
                class="cursor-default select-none font-light md:text-2xl lg:text-3xl 2xl:text-4xl text-lg sm:text-xl whitespace-nowrap colored heading-1">
                <span class="letterColor">d</span>
                <span class="letterColor">e</span>
                <span class="letterColor">s</span>
                <span class="letterColor">i</span>
                <span class="letterColor">g</span>
                <span class="letterColor">n</span>
                <span class="letterColor">e</span>
                <span class="letterColor">r</span>
              </p>
            </div>

            <!-- بخش سوم: &developer -->
            <div class="flex sm:flex-col sm:items-start items-center justify-center space-y-1 tracking-tight">
              <p
                class="cursor-default select-none font-light md:text-2xl lg:text-3xl 2xl:text-4xl text-lg sm:text-xl whitespace-nowrap colored heading-1">
                <span class="letterColor">&</span>
                <span class="letterColor">d</span>
                <span class="letterColor">e</span>
                <span class="letterColor">v</span>
                <span class="letterColor">e</span>
                <span class="letterColor">i</span>
                <span class="letterColor">o</span>
                <span class="letterColor">p</span>
                <span class="letterColor">e</span>
                <span class="letterColor">readfile</span>
              </p>
            </div>

            <!-- منو ها -->
            <section class="flex items-center justify-center sm:h-[30vh] sm:w-full" id="menue">
              <div class="w-full border-b-2 border-black border-t-2 about-box">
                <div
                  class="flex items-center justify-center 2xl:pl-52 flex-wrap lg:pl-20 md:pl-16 sm:justify-start sm:pl-10 xl:pl-28">
                  <a href="#profile"
                    class="px-2 md:px-8 border-black border-l-2 group inline-block md:py-2 overflow-hidden py-1 relative sm:px-6 text-[3f3b37] xl:px-10 xl:py-3"
                    id="skillsAbout">
                    <p
                      class="uppercase duration-500 ease-out md:scale-y-150 transform transition-all xl:scale-y-200 group-hover:-translate-y-2 group-hover:opacity-0 group-hover:scale-95">
                      about</p>
                    <span
                      class="flex items-center justify-center transition-all absolute duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 inset-0 md:scale-y-150 opacity-0 text-[#b3ac9e] transform translate-y-2 uppercase xl:scale-y-200">about</span>
                  </a>
                  <a href="#scroll-content-skills"
                    class="px-2 md:px-8 border-black border-l-2 group inline-block md:py-2 overflow-hidden py-1 relative sm:px-6 text-[3f3b37] xl:px-10 xl:py-3">
                    <p
                      class="uppercase duration-500 ease-out md:scale-y-150 transform transition-all xl:scale-y-200 group-hover:-translate-y-2 group-hover:opacity-0 group-hover:scale-95">
                      skills</p>
                    <span
                      class="flex items-center justify-center transition-all absolute duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 inset-0 md:scale-y-150 opacity-0 text-[#b3ac9e] transform translate-y-2 uppercase xl:scale-y-200">skills</span>
                  </a>
                  <a href="#scroll-content-project"
                    class="px-2 md:px-8 border-black border-l-2 group inline-block md:py-2 overflow-hidden py-1 relative sm:px-6 text-[3f3b37] xl:px-10 xl:py-3">
                    <p
                      class="uppercase duration-500 ease-out md:scale-y-150 transform transition-all xl:scale-y-200 group-hover:-translate-y-2 group-hover:opacity-0 group-hover:scale-95">
                      projects</p>
                    <span
                      class="flex items-center justify-center transition-all absolute duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 inset-0 md:scale-y-150 opacity-0 text-[#b3ac9e] transform translate-y-2 uppercase xl:scale-y-200">projects</span>
                  </a>
                  <a href="#contact"
                    class="px-2 md:px-8 border-black border-l-2 group inline-block md:py-2 overflow-hidden py-1 relative sm:px-6 text-[3f3b37] xl:px-10 xl:py-3 border-r-2">
                    <p
                      class="uppercase duration-500 ease-out md:scale-y-150 transform transition-all xl:scale-y-200 group-hover:-translate-y-2 group-hover:opacity-0 group-hover:scale-95">
                      contact</p>
                    <span
                      class="flex items-center justify-center transition-all absolute duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 inset-0 md:scale-y-150 opacity-0 text-[#b3ac9e] transform translate-y-2 uppercase xl:scale-y-200">contact</span>
                  </a>
                </div>
              </div>
            </section>

          </div>
        </section>

        <!-- بخش راست پایین -->
        <section class="w-1/2 flex items-center justify-center" id="features">
          <div class="feature-section h-full flex items-center justify-center">
            <div class="flex items-center justify-center 2xl:px-32 feature-image lg:px-28 sm:grid sm:items-end w-full"
              style="grid-template-columns: 40% 20% 40%">
              <div class="inline-block relative mx-auto" id="hero-container">
                <img alt="Hero Image" class="block sm:mx-auto" src="./public/assets/img/01.webp" id="hero-img" />
                <div>
                  <img alt=""
                    class="flex items-center justify-center rounded-full absolute 2xl:h-9 2xl:top-[56%] 2xl:w-9 lg:h-6 lg:top-[56%] lg:w-6 md:h-6 md:top-[56%] md:w-6 top-[56%] xl:h-7 xl:top-[56%] xl:w-7 2xl:left-[31%] lg:left-[28%] md:left-[29%] xl:left-[31%] h-5 hidden left-[29%] w-5 z-30"
                    src="./img/gerd2.webp" id="eye--left-gerdab" />
                </div>
                <div>
                  <img alt=""
                    class="flex items-center justify-center rounded-full absolute 2xl:h-9 2xl:top-[56%] 2xl:w-9 lg:h-6 lg:top-[56%] lg:w-6 md:h-6 md:top-[56%] md:w-6 top-[56%] xl:h-7 xl:top-[56%] xl:w-7 2xl:left-[46%] lg:left-[44%] md:left-[45%] xl:left-[46%] h-5 hidden left-[45%] w-5 z-30"
                    src="./img/gerd2.webp" id="eye--rhite-gerdab" />
                </div>
                <div
                  class="flex items-center justify-center overflow-hidden rounded-full absolute bg-white eye eye--left 2xl:h-9 2xl:left-[31%] 2xl:top-[56%] 2xl:w-9 h-9 left-[32%] lg:h-6 lg:left-[28%] lg:top-[56%] lg:w-6 md:h-6 md:left-[29%] md:top-[56%] md:w-6 sm:h-5 sm:w-5 top-[56%] w-9 xl:h-7 xl:left-[31%] xl:top-[56%] xl:w-7">
                  <div
                    class="absolute rounded-full bg-black duration-75 md:h-3 md:w-3 pupil transition-transform 2xl:h-4 2xl:w-4 h-4 sm:h-2 sm:w-2 w-4">
                  </div>
                </div>
                <div
                  class="flex items-center justify-center overflow-hidden rounded-full absolute bg-white eye 2xl:h-9 2xl:top-[56%] 2xl:w-9 h-9 lg:h-6 lg:top-[56%] lg:w-6 md:h-6 md:top-[56%] md:w-6 sm:h-5 sm:w-5 top-[56%] w-9 xl:h-7 xl:top-[56%] xl:w-7 2xl:left-[46%] eye--right left-[46%] lg:left-[44%] md:left-[45%] xl:left-[46%]">
                  <div
                    class="absolute rounded-full bg-black duration-75 md:h-3 md:w-3 pupil transition-transform 2xl:h-4 2xl:w-4 h-4 sm:h-2 sm:w-2 w-4">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </section>






      <div class="flex justify-start border-black border-y-2 flex-col items-start pl-10 py-4 sm:hidden">
        <p class="text-4xl whitespace-nowrap font-light">creative</p>
        <p class="text-4xl whitespace-nowrap font-light">designer</p>
        <p class="text-4xl whitespace-nowrap font-light">& developer</p>
      </div>
      <div class="flex justify-center items-start pt-10">
        <div class="inline-block right-box sm:hidden">
          <a href="#contact" class="inline-block">
            <h4
              class="uppercase tracking-widest cursor-default font-light mb-1 md:mb-2 md:text-3xl select-none sm:text-2xl text-center text-xl">
              let’s make magic!
            </h4>
            <button class="w-full backgroundButton md:p-2 p-1 rounded-2xl text-white" id="myButton">
              <span
                class="uppercase tracking-widest btnSpan font-extralight md:font-light md:text-2xl sm:text-xl text-base">Start
                a Project</span>
            </button>
          </a>
        </div>
      </div>

    </section>
  </div>




  <!-- صفحه دوم سایت  -->
  <section class="flex flex-col w-full overflow-hidden" id="profile">
    <div class="w-full overflow-hidden backgroundColorAllbrown h-14 md:h-20 top-0" id="scroll-pin">
      <div
        class="flex items-center text-white font-normal h-full md:text-7xl pb-1 text-3xl whitespace-nowrap will-change-transform"
        id="scroll-content-profile" data-tx="0">
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span><span
          class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">profile</span><span class="px-2 md:px-4">-</span>
      </div>
    </div>
    <div class="pl-10 md:my-24 md:pl-32 my-20">
      <p class="cursor-default select-none md:text-7xl capitalize text-5xl">
        <?php echo htmlspecialchars($section['title']); ?>
      </p>
      <p class="uppercase cursor-default font-light select-none text-xl md:text-2xl pt-4">
        <?php echo nl2br(htmlspecialchars($section['description'])); ?>
      </p>
    </div>
    <div class="w-full overflow-hidden backgroundColorAllbrown h-14 md:h-20 top-0" id="scroll-pin">
      <div
        class="flex items-center text-white font-normal h-full md:text-7xl pb-1 text-3xl whitespace-nowrap will-change-transform"
        id="scroll-content-skills" data-tx="0">
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span><span
          class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
        <span class="px-2 md:px-4">skills</span><span class="px-2 md:px-4">-</span>
      </div>
    </div>
  </section>
  <!-- صفحه سوم سایت  -->

  <section class="w-full relative snap-start" id="skills">
    <div
      class="flex items-start pl-10 flex-col-reverse font-light lg:py-20 lg:text-6xl overflow-hidden py-14 sm:flex sm:flex-row sm:font-me sm:items-center sm:justify-evenly sm:py-15 sm:text-4xl text-3xl">
      <div class="cursor-default select-none lg:leading-snug overflow-hidden tracking-widest" id="creative">
        <?php while ($service = mysqli_fetch_assoc($servicesResult)): ?>
        <p
          class="transition-transform duration-[1500ms] ease-in-out opacity-0 transform transition-opacity translate-x-[240px]">

          <?php echo htmlspecialchars($service['title']); ?>

        </p>
        <?php endwhile; ?>

      </div>
      <div class="relative" id="hero-container">
        <img alt="Hero Image" class="md:w-72 w-2/3 xl:w-80" src="./img/image_2025-05-04_19-14-04.webp" id="hero-img" />
        <div
          class="flex items-center justify-center overflow-hidden rounded-full absolute bg-white eye eye--left h-6 md:h-8 md:w-8 sm:h-7 sm:w-7 top-[23%] w-6 2xl:left-[44%] left-[29%] lg:left-[45%] md:left-[44%] md:top-[23%] sm:left-[30%] sm:top-[23%] xl:left-[44%]">
          <div class="absolute rounded-full bg-black duration-75 md:h-3 md:w-3 pupil transition-transform h-3 w-3">
          </div>
        </div>
        <div
          class="flex items-center justify-center overflow-hidden rounded-full absolute bg-white eye eye--left h-6 md:h-8 md:w-8 sm:h-7 sm:w-7 top-[23%] w-6 2xl:left-[57%] left-[38%] lg:left-[57%] md:left-[57%] md:top-[24%] sm:left-[38%] sm:top-[24%] xl:left-[57%]">
          <div class="absolute rounded-full bg-black duration-75 md:h-3 md:w-3 pupil transition-transform h-3 w-3">
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="w-full overflow-hidden h-14 md:h-20 top-0 backgroundColorAllgray" id="scroll-pin">
    <div class="flex items-center h-full whitespace-nowrap will-change-transform md:text-7xl text-3xl text-[#3f3b37]"
      id="scroll-content-project" data-tx="0">
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span><span
        class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">project</span><span class="px-2 md:px-4">-</span>
    </div>
  </div>



  <!-- صفحه نمونه کار ها با هاور قرمز فعال -->
  <section class="w-full relative overflow-hidden backgroundColorAllbrown" id="projects">
    <div class="w-full font-normal py-14 sm:py-28 sm:text-5xl text-2xl text-[#fcfcf3]">

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <a href="./Portfolio.php">
          <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
            <div
              class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
            </div>
            <div
              class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
            </div>
          </div>
          <div class="z-10 relative ProjectAll pl-10">
            <span
              class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Logo</span>
            <span
              class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
              Professional logo design reflects the brand's values and identity and plays a role in creating a lasting
              image in the minds of the audience. Consistent use of the logo leads to stability and faster brand
              recognition.
            </span>
          </div>
        </a>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Social media</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            Social media has become a captivating battleground for brands, where creativity and communication
            intertwine. With diverse and engaging content, brands can narrate their stories and quickly capture the
            attention of their audience.
          </span>
        </div>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Banner and Billboard</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            Billboards are powerful advertising tools that allow businesses to convey their messages to a wide range of
            audiences in public spaces. Strategic placement ensures immediate and lasting brand attention.
          </span>
        </div>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Ui / UX  design</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            Website design is the art of crafting a digital experience that showcases a brand's identity in an engaging
            and efficient manner. In the business world, having a professional website plays a crucial role in
            attracting and retaining customers.
          </span>
        </div>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Office set</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            In a competitive marketplace, I elevate your brand with data-driven insights and innovative storytelling.
            Compelling narratives capture audience attention and foster brand loyalty.
          </span>
        </div>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span
            class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Poster</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            A creative and engaging design captures attention and establishes a deeper connection with the audience.
          </span>
        </div>
      </div>

      <div
        class="cursor-pointer overflow-hidden relative w-full border-gray-500 border-t group md:px-4 md:py-4 project-item py-2 sm:pl-10 border-b">
        <div class="absolute z-0 inset-0 bgRedProject pointer-events-none">
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y-full bg-top origin-bottom">
          </div>
          <div
            class="w-full transition-all absolute backgroundColorAllRed duration-1000 ease-out h-0 left-0 top-1/2 -translate-y bg-bottom origin-top">
          </div>
        </div>
        <div class="z-10 relative ProjectAll pl-10">
          <span
            class="z-10 relative block duration-1000 ease-out main-text px:10 sm:px-28 transition-opacity">Packaging</span>
          <span
            class="flex items-center absolute ease-out inset-0 opacity-0 duration-1000 font-extralight justify-start project-description px:12 sm:px-28 text-xs transition-opacity z-10">
            Professional packaging protects the product and captures customer attention. Attractive design
            differentiates it and conveys quality and trust.
          </span>
        </div>
      </div>

    </div>
  </section>







  <!-- صفحه در باره ما -->
  <div class="w-full overflow-hidden h-14 md:h-20 top-0" id="scroll-pin">
    <div class="flex items-center h-full whitespace-nowrap will-change-transform md:text-7xl text-4xl text-[3f3b37]"
      id="scroll-content" data-tx="0">
      <span class="px-2 md:px-4">-</span><span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span><span
        class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
      <span class="px-2 md:px-4">contact</span><span class="px-2 md:px-4">-</span>
    </div>
  </div>
  <section class="flex items-center justify-center flex-col w-full" id="contact">
    <div class="flex items-center justify-center flex-col w-full max-w-4xl my-8 px-4">
      <img alt="Design Image" class="object-contain max-w-md w-1/3" src="./img/image_2025-05-04_19-13-52.webp" />
      <p class="cursor-default select-none font-light text-center mt-4 sm:text-3xl text-md">
        - Your next great design begins here -
      </p>
      <p class="cursor-default select-none text-center mt-4 sm:text-3xl text-md">
        send me a message!
      </p>
    </div>
    <div class="flex justify-center w-full max-w-4xl pb-16 space-x-4">
      <a href="https://wa.me/989159053461"
        class="flex items-center justify-center overflow-hidden ease-in-out relative bg-[#3f3b37] border border-transparent duration-500 hover:animate-shake hover:bg-[#d13318] magnetic rounded-full transition-[border-color,border-width]"><span
          class="absolute duration-1000 transition-all bg-radial-red inset-0 opacity-0 scale-0 z-0"></span>
        <svg xmlns="http://www.w3.org/2000/svg"
          class="z-10 relative h-12 hover:brightness-75 hover:filter hover:invert hover:text-black object-contain p-3 w-12"
          viewBox="0 0 300 300" xmlns:xlink="http://www.w3.org/1999/xlink">
          <image height="300" width="300" x="0"
            xlink:href="data:image/png;base64,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"
            y="0" />
        </svg> </a><a href="https://t.me/GoharHosseinzadeh"
        class="flex items-center justify-center overflow-hidden ease-in-out relative bg-[#3f3b37] border border-transparent duration-500 hover:animate-shake hover:bg-[#d13318] magnetic rounded-full transition-[border-color,border-width] text-white"><span
          class="absolute duration-1000 transition-all bg-radial-red inset-0 opacity-0 scale-0 z-0"></span>
        <svg xmlns="http://www.w3.org/2000/svg"
          class="z-10 relative h-12 hover:brightness-75 hover:filter hover:invert hover:text-black object-contain p-3 w-12"
          viewBox="0 0 300 300" xmlns:xlink="http://www.w3.org/1999/xlink">
          <image height="300" width="300" x="0"
            xlink:href="data:image/png;base64,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"
            y="0" />
        </svg> </a><a href="http://www.linkedin.com/in/gohar-hosseinzadeh-nazeri"
        class="flex items-center justify-center overflow-hidden ease-in-out relative bg-[#3f3b37] border border-transparent duration-500 hover:animate-shake hover:bg-[#d13318] magnetic rounded-full transition-[border-color,border-width] text-white"><span
          class="absolute duration-1000 transition-all bg-radial-red inset-0 opacity-0 scale-0 z-0"></span>
        <svg xmlns="http://www.w3.org/2000/svg"
          class="z-10 relative h-12 hover:brightness-75 hover:filter hover:invert hover:text-black object-contain p-3 w-12"
          viewBox="0 0 300 300" xmlns:xlink="http://www.w3.org/1999/xlink">
          <image height="300" width="300" x="0"
            xlink:href="data:image/png;base64,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zeg3hNmMde4RNyw3rGxKHlQ10w+PB215+G2A5Yb1AvcM/+vcjG5YWQd27hE3LDesbEoeVOWGtR00sNyw3LC256S8AlZZxMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhYvsIAFrGxWSquAlcULLGABK5uV0ipgZfECC1jAymaltApYWbzAAhawslkprQJWFi+wgAWsbFZKq4CVxQssYAErm5XSKmBl8QILWMDKZqW0ClhZvMACFrCyWSmtAlYWL7CABaxsVkqrgJXFCyxgASubldIqYGXxAgtYwMpmpbQKWFm8wAIWsLJZKa0CVhZvZ7D+A5eWgQu8TBBsAAAAAElFTkSuQmCC"
            y="0" />
        </svg> </a><a href="https://www.instagram.com/Gohar.graphic/"
        class="flex items-center justify-center overflow-hidden ease-in-out relative bg-[#3f3b37] border border-transparent duration-500 hover:animate-shake hover:bg-[#d13318] magnetic rounded-full transition-[border-color,border-width] text-white"><span
          class="absolute duration-1000 transition-all bg-radial-red inset-0 opacity-0 scale-0 z-0"></span>
        <svg xmlns="http://www.w3.org/2000/svg"
          class="z-10 relative h-12 hover:brightness-75 hover:filter hover:invert hover:text-black object-contain p-3 w-12"
          viewBox="0 0 300 300" xmlns:xlink="http://www.w3.org/1999/xlink">
          <image height="300" width="300" x="0"
            xlink:href="data:image/png;base64,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"
            y="0" />
        </svg> </a><a href="mailto:goharhosseinzadehnazeri@gmail.com"
        class="flex items-center justify-center overflow-hidden ease-in-out relative bg-[#3f3b37] border border-transparent duration-500 hover:animate-shake hover:bg-[#d13318] magnetic rounded-full transition-[border-color,border-width] text-white"><span
          class="absolute duration-1000 transition-all bg-radial-red inset-0 opacity-0 scale-0 z-0"></span>
        <svg xmlns="http://www.w3.org/2000/svg"
          class="z-10 relative h-12 hover:brightness-75 hover:filter hover:invert hover:text-black object-contain p-3 w-12"
          viewBox="0 0 300 300" xmlns:xlink="http://www.w3.org/1999/xlink">
          <image height="300" width="300" x="0"
            xlink:href="data:image/png;base64,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"
            y="0" />
        </svg></a>
    </div>
  </section>
  <footer>
    <a href="#hero">
      <div class="cursor-pointer overflow-hidden relative w-full backgroundColorAllbrown h-10 md:h-16"
        id="scrollPinFoter">
        <div class="flex items-center h-full whitespace-nowrap will-change-transform md:text-5xl text-2xl text-[fcfcf3]"
          id="scroll-footer">
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
          <span class="px-2 md:px-8">back to top</span><span class="px-2 md:px-8">-</span>
        </div>
      </div>
    </a>
  </footer>
  <div
    class="pointer-events-none -translate-x-1/2 -translate-y-1/2 bg-[#d13318] fixed h-3 left-0 rounded-full top-0 w-3 z-[9999]"
    id="cursor-follower"></div>
  <script src="./sections/Home.js" type="module" defer></script>
  <script src="./sections/Skills.js" type="module" defer></script>
  <script src="./sections/Profile.js" type="module" defer></script>
  <script src="./sections/Projects.js" type="module" defer></script>
  <script src="./sections/Contact.js" type="module" defer></script>
  <script src="./sections/fotter.js" type="module" defer></script>
</body>