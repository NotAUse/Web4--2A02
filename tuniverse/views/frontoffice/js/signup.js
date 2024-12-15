document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Collect form data
    const formData = {
        fullName: document.querySelector('input[name="fullName"]').value,
        email: document.querySelector('input[name="email"]').value,
        hometown: document.querySelector('select[name="hometown"]').value,
        mainInterest: document.querySelector('select[name="mainInterest"]').value,
        profilePicture: null, // Will be updated if picture is uploaded
        additionalInterests: [], // For future additional interests
        discoveries: [], // For future discoveries
        culturalPoints: 0 // Starting points
    };
    
    // Handle profile picture upload
    const profilePictureInput = this.profilePicture;
    
    if (profilePictureInput.files.length > 0) {
        const reader = new FileReader();
        reader.onloadend = function() {
            // Store profile picture as base64
            formData.profilePicture = reader.result;
            
            // Save to localStorage
            localStorage.setItem('userProfile', JSON.stringify(formData));
            
            // Redirect to profile page
            window.location.href = 'profile.html';
        }
        reader.readAsDataURL(profilePictureInput.files[0]);
    } else {
        // If no picture, save without picture
        localStorage.setItem('userProfile', JSON.stringify(formData));
        window.location.href = 'profile.html';
    }
    
});


