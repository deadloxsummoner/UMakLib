document.getElementById('bookCoverInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const resultBarImg = document.getElementById('resultBarImage'); // Ensure you're targeting the correct ID
            resultBarImg.style.backgroundImage = 'url(' + e.target.result + ')'; // Set the background to the selected image
        };

        reader.readAsDataURL(file); // Read the image file as a data URL
    }
    });

