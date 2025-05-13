document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.getElementById('burgerMenu');
    const navMenu = document.getElementById('navMenu');
    const closeModalBtn = document.getElementById('closeModal');
    const adoptModal = document.getElementById('adoptModal');
    const adoptForm = document.getElementById('adoptForm');
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    const petImages = {
        dog: ['images/dog1.jpg', 'images/dog2.jpg', 'images/dog3.jpg'],
        cat: ['images/cat1.jpg', 'images/cat2.jpg', 'images/cat3.jpg'],
        other: ['images/rabbit.jpg', 'images/hamster.jpg', 'images/parrot.jpg']
    };

    const petData = [
        { name: 'Buddy', type: 'dog', description: 'Friendly and energetic.' },
        { name: 'Mittens', type: 'cat', description: 'Independent and playful.' },
        { name: 'Fluffy', type: 'cat', description: 'Sweet and cuddly.' },
        { name: 'Charlie', type: 'dog', description: 'Loyal and loving.' }
    ];

    function toggleNav() {
        navMenu.classList.toggle('show');
    }

    function closeNav() {
        navMenu.classList.remove('show');
    }

    function searchPets() {
        const query = searchInput.value.toLowerCase();
        searchResults.innerHTML = '';

        const filteredPets = petData.filter(pet =>
            pet.name.toLowerCase().includes(query) ||
            pet.type.toLowerCase().includes(query) ||
            pet.description.toLowerCase().includes(query)
        );

        filteredPets.forEach(pet => {
            const petDiv = document.createElement('div');
            petDiv.classList.add('pet-card');
            const petImg = document.createElement('img');
            petImg.src = petImages[pet.type][Math.floor(Math.random() * petImages[pet.type].length)];
            petImg.alt = pet.name;
            petDiv.appendChild(petImg);

            const petName = document.createElement('h3');
            petName.textContent = pet.name;
            petDiv.appendChild(petName);

            const petDesc = document.createElement('p');
            petDesc.textContent = pet.description;
            petDiv.appendChild(petDesc);

            const likeButton = document.createElement('button');
            likeButton.innerHTML = '❤️';
            likeButton.onclick = () => toggleLike(likeButton);
            petDiv.appendChild(likeButton);

            const adoptButton = document.createElement('button');
            adoptButton.textContent = 'Adopt Me';
            adoptButton.onclick = () => showModal(pet);
            petDiv.appendChild(adoptButton);

            searchResults.appendChild(petDiv);
        });
    }

    function showModal(pet) {
        adoptModal.style.display = 'block';
        adoptForm.elements['petName'].value = pet.name;
    }

    function closeModal() {
        adoptModal.style.display = 'none';
    }

    function adoptPet(event) {
        event.preventDefault();
        const formData = new FormData(adoptForm);
        const adopterInfo = {
            name: formData.get('name'),
            surname: formData.get('surname'),
            phone: formData.get('phone'),
            petName: formData.get('petName')
        };

        alert(`Adopted ${adopterInfo.petName} by ${adopterInfo.name} ${adopterInfo.surname}. Phone: ${adopterInfo.phone}`);
        closeModal();
    }

    function toggleLike(likeButton) {
        likeButton.classList.toggle('liked');
        if (likeButton.classList.contains('liked')) {
            likeButton.innerHTML = '💖';
        } else {
            likeButton.innerHTML = '❤️';
        }
    }

    burgerMenu.addEventListener('click', toggleNav);
    closeModalBtn.addEventListener('click', closeModal);
    adoptForm.addEventListener('submit', adoptPet);
    searchInput.addEventListener('input', searchPets);
    window.addEventListener('click', (e) => {
        if (e.target === adoptModal) closeModal();
    });
});
