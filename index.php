<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/db.php";
$result = $connection->query(
    "SELECT * FROM profile ORDER BY id LIMIT 1"
);

$profile = $result->fetch_assoc();

if (!$profile) {
    exit("no data available");
}

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
$skills = $connection->query(
    "SELECT id, name, description FROM skills ORDER BY id"
);

$projects = $connection->query(
    "SELECT id, name, description FROM project ORDER BY id"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Eng.mohammad</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header class="site-header">
        <div class="header-wrap container">
            <a href="#hero" class="logo">
                mohammad<span>.</span>
            </a>

            <nav class="header-nav" aria-label="Main navigation">
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#projects">projects</a>
                <a href="#contact">Contact</a>
            </nav>

            <button type="button" id="theme-toggle" class="theme-toggle"
                aria-pressed="false"> Dark Mode
            </button>
        </div>
    </header>

    <main>
        <section id="hero" class="hero-section">
            <div class="container">
                <p class="tag">Hello, I’m</p>

                <h1><?= escape($profile["name"])?></h1>
                <h2><?= escape($profile["job"])?></h2>

                
            </div>
        </section>

        <section id="about">
            <div class="about-section container">
                <img
                    src="foto.jpg"
                    alt="Mohammad Rada"
                    width="195"
                >

                <div class="about-content">
                    <p class="about-tag">About Me</p>

                    <h2 class="about-title">
                        A little about myself
                        ⁠Software Engineering student at the University of Hail, passionate about building smart systems, technical project management (CAPM certified), and delivering innovative software solutions.

                    </h2>

                    <p class="about-p">
                       <?= escape($profile["about"])?>
                    </p>
                </div>
            </div>
        </section>

           <section id="skills" class="section">
             <div class="skills-section container">
             <p class="skills-tag">What I Know</p>
             <h2 class="about-title">My Skills</h2>

             <div class="skills-grid">
            <?php while ($skill = $skills->fetch_assoc()): ?>
                <div class="skills-card">
                    <h3 class="skill-title">
                        <?= escape($skill["name"]) ?>
                    </h3>

                    <p class="skill-des">
                        <?= escape($skill["description"]) ?>
                    </p>
                 </div>
                   <?php endwhile; ?>
                 </div>
                 </div>
                 </section>

      <section id="projects" class="section">
         <div class="proj-section container">
                 <p class="skills-tag">PORTFOLIO</p>
                  <h2 class="about-title">My project</h2>

            <div class="proj-grid">
             <?php $number = 1; ?>

              <?php while ($project = $projects->fetch_assoc()): ?>
               <div class="proj-card">
            <div class="proj-card-num">
                <?= $number++ ?>
            </div>

            <h3 class="proj-card-title">
                <?= escape($project["name"]) ?>
            </h3>

            <p class="proj-card-des">
                <?= escape($project["description"]) ?>
            </p>
          </div>
              <?php endwhile; ?>
          </div>
          </div>
          </section>

        <section id="contact" class="section">
            <div class="container">

                <h2>Contact Me</h2>

                <p>
                    Have a question ?
                </p>

                <form action="F.php" method="post" class="contact-form">
                    
                    <div class="form-group">
                        <label for="name">Name</label>

                        <input type="text" id="name" name="name" placeholder="Enter your name" autocomplete="name"
                         maxlength="90" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email" id="email"  name="email" placeholder="Enter your email" autocomplete="email"
                            maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>

                        <textarea id="message" name="message" rows="6" placeholder="Write your message"
                        maxlength="40000" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        send Message
                    </button>
                </form>

                <p>
                    Email:
                    <a href="mailto:<?= escape(trim($profile["email"]))?>">
                        <?= escape(trim($profile["email"]))?>           
                         </a>
                </p>

                <p>
                    Phone:
                    <a href="tel:<?= escape(trim($profile["phone"]))?>">
                       <?= escape(trim($profile["phone"]))?>
                    </a>
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>
                &copy; 2026 Mohammed Rada Built using HTML.
            </p>
        </div>
    </footer>
</body>
</html>