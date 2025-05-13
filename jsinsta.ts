 function submitPost() {
      const caption = document.getElementById('caption').value;
      const imageFile = document.getElementById('imageUpload').files[0];

      if (!caption && !imageFile) return;

      const reader = new FileReader();
      reader.onload = function(event) {
        const imageUrl = event.target.result;

        const postHTML = `
          <div class="post">
            ${imageUrl ? `<img src="${imageUrl}" alt="Post Image">` : ''}
            <p>${caption}</p>
            <div class="actions">
              <span class="like-btn" onclick="toggleLike(this)">❤️</span>
              <button onclick="toggleCommentBox(this)">💬 Comment</button>
            </div>
            <div class="comment-box" style="display:none;">
              <input type="text" placeholder="Write a comment...">
            </div>
          </div>
        `;

        document.getElementById('postContainer').insertAdjacentHTML('afterbegin', postHTML);
        document.getElementById('caption').value = '';
        document.getElementById('imageUpload').value = '';
      }

      if (imageFile) {
        reader.readAsDataURL(imageFile);
      } else {
        reader.onload({ target: { result: null } });
      }
    }

    function toggleLike(element) {
      element.classList.toggle('liked');
    }

    function toggleCommentBox(button) {
      const commentBox = button.parentElement.nextElementSibling;
      commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';
    }
 