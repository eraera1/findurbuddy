<?php
require 'db.php';

$posts = $conn->query("SELECT * FROM tab_post ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Petstagram</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #ffdde1, #ee9ca7);
      color: #333;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #ff4081;
      font-size: 3rem;
    }

    form, .post {
      background-color: white;
      border-radius: 15px;
      padding: 20px;
      max-width: 600px;
      margin: 20px auto;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      animation: fadeIn 1s ease;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 10px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #ff4081;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #ff6789;
    }

    img {
      width: 100%;
      border-radius: 10px;
      margin-top: 10px;
    }

    .comments {
      margin-top: 10px;
    }

    .comments form {
      margin-top: 10px;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
  <link rel="stylesheet" href="petstagram.css">
</head>
<body>

<h1>🐾 Petstagram 🐾</h1>

<form action="upload_post.php" method="post" enctype="multipart/form-data">
  <textarea name="caption" placeholder="Write your caption..." required></textarea>
  <input type="file" name="image" accept="image/*">
  <button type="submit">Post</button>
</form>

<?php while ($row = $posts->fetch_assoc()): ?>
  <div class="post">
    <?php if ($row['image_path']): ?>
      <img src="<?= $row['image_path'] ?>" alt="Post image">
    <?php endif; ?>
    <p><?= htmlspecialchars($row['caption']) ?></p>

    <div class="comments">
      <strong>Comments:</strong>
      <?php
        $post_id = $row['id'];
        $comments = $conn->query("SELECT * FROM tab_comments WHERE post_id = $post_id ORDER BY created_at ASC");
        while ($c = $comments->fetch_assoc()):
      ?>
        <p>- <?= htmlspecialchars($c['comment']) ?></p>
      <?php endwhile; ?>

      <form action="upload_comment.php" method="post">
        <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
        <input type="text" name="comment" placeholder="Add a comment..." required>
        <button type="submit">Comment</button>
      </form>
    </div>
  </div>
<?php endwhile; ?>

</body>
</html>
