function changeHeaderImage(imageNumber) {
  const headerImg = document.getElementById('header-img');
  switch (imageNumber) {
    case 1:
      headerImg.style.backgroundImage = "url('images/relaxed.jpg')";
      break;
    case 2:
      headerImg.style.backgroundImage = "url('images/playful.jpg')";
      break;
    case 3:
      headerImg.style.backgroundImage = "url('images/moderate.jpg')";
      break;
  }
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function getPetMatch() {
  const activity = document.querySelector('input[name="activity"]:checked')?.value;
  const type = document.querySelector('input[name="type"]:checked')?.value;
  const personality = document.querySelector('input[name="personality"]:checked')?.value;

  let match = "Hmm... we couldn't figure it out!";
  if (activity && type && personality) {
    if (type === "dog" && activity === "high" && personality === "cuddly") {
      match = "You'd love a Golden Retriever 🐕 – super playful and affectionate!";
    } else if (type === "cat" && activity === "low" && personality === "independent") {
      match = "Try a British Shorthair 🐈 – relaxed and classy.";
    } else if (type === "both") {
      match = "Try a mixed-buddy home! 🐶🐱 Maybe a calm Lab and a curious cat!";
    } else {
      match = "You might love a Shiba Inu or a Maine Coon!";
    }
  }

  document.getElementById('matchResult').innerText = match;
}

const pets = [
  { name: "Bella", type: "Dog", image: "images/dog1.jpg", description: "Playful and loyal." },
  { name: "Milo", type: "Cat", image: "images/cat1.jpg", description: "Quiet and sweet." },
  { name: "Rocky", type: "Dog", image: "images/dog2.jpg", description: "Energetic and fun!" },
  { name: "Luna", type: "Cat", image: "images/cat2.jpg", description: "Loves naps and cuddles." },
  { name: "Toby", type: "Dog", image: "images/dog3.jpg", description: "Smart and alert." },
  { name: "Nala", type: "Cat", image: "images/cat3.jpg", description: "Chill and curious." }
];

function showRandomPets() {
  const gallery = document.getElementById('petGallery');
  gallery.innerHTML = "";
  const shuffled = pets.sort(() => 0.5 - Math.random()).slice(0, 3);

  shuffled.forEach(pet => {
    const card = document.createElement('div');
    card.className = "pet-card";
    card.innerHTML = `
      <img src="${pet.image}" alt="${pet.name}">
      <h3>${pet.name}</h3>
      <p>${pet.description}</p>
    `;
    gallery.appendChild(card);
  });
}

function submitComment() {
  const name = document.getElementById('name').value.trim();
  const message = document.getElementById('message').value.trim();
  if (name && message) {
    const commentDiv = document.createElement('div');
    commentDiv.className = 'comment';
    commentDiv.innerHTML = `<strong>${name}</strong>: ${message}`;
    document.getElementById('commentSection').appendChild(commentDiv);
    document.getElementById('commentForm').reset();
  }
}

const petImages = {
  dog: ['images/dog1.jpg', 'images/dog2.jpg', 'images/dog3.jpg'],
  cat: ['images/cat1.jpg', 'images/cat2.jpg', 'images/cat3.jpg'],
  other: ['images/rabbit.jpg', 'images/hamster.jpg', 'images/parrot.jpg']
};

function searchPets() {
  const category = document.getElementById('petCategory').value;
  const gallery = document.getElementById('petGallery');
  gallery.innerHTML = '';

  const selectedImages = petImages[category];
  selectedImages.forEach(imgPath => {
    const img = document.createElement('img');
    img.src = imgPath;
    img.alt = category;
    img.className = 'pet-img';
    gallery.appendChild(img);
  });
}

function toggleQuiz() {
  const quizForm = document.getElementById('quizForm');
  quizForm.style.display = quizForm.style.display === 'none' ? 'block' : 'none';
}
function searchPets() {
  const query = document.getElementById("searchInput").value.toLowerCase();
  const results = document.getElementById("searchResults");
  results.innerHTML = "";

  const filtered = pets.filter(pet =>
    pet.name.toLowerCase().includes(query) ||
    pet.type.toLowerCase().includes(query) ||
    pet.description.toLowerCase().includes(query)
  );

  if (filtered.length === 0) {
    results.innerHTML = "<p>No pets found matching your search 🐾</p>";
    return;
  }

  filtered.forEach(pet => {
    const card = document.createElement("div");
    card.className = "result-card";
    card.innerHTML = `
      <img src="${pet.image}" alt="${pet.name}" />
      <h3>${pet.name}</h3>
      <p>${pet.description}</p>
    `;
    results.appendChild(card);
  });
}
