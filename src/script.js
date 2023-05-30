// Add an event listener to each day element
var dayElements = document.querySelectorAll('.day_num');
dayElements.forEach(function(dayElement) {
  var spanElement = dayElement.querySelector('span');
  spanElement.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent click event from propagating to dayElement

    // Get the day number from the clicked span's text content
    var dayNumber = this.textContent;

    // Hide all pop-up forms
    var popUpForms = document.querySelectorAll('.pop-up-form');
    popUpForms.forEach(function(popUpForm) {
      popUpForm.style.display = 'none';
    });

    // Show the corresponding pop-up form
    var popUpForm = document.getElementById('popUpForm' + dayNumber);
    popUpForm.style.display = 'block';

    // Show the overlay
    var popUpOverlay = document.querySelector('.pop-up-overlay');
    popUpOverlay.style.display = 'block';
  });
});

// Add click event listener to the overlay
var popUpOverlay = document.querySelector('.pop-up-overlay');
popUpOverlay.addEventListener('click', function() {
  // Hide all pop-up forms
  var popUpForms = document.querySelectorAll('.pop-up-form');
  popUpForms.forEach(function(popUpForm) {
    popUpForm.style.display = 'none';
  });

  // Hide the overlay
  this.style.display = 'none';
});

// Add click event listener to the document
document.addEventListener('click', function(event) {
  // Check if the click event occurred outside any pop-up form
  var isOutsidePopUpForm = true;
  var popUpForms = document.querySelectorAll('.pop-up-form');
  popUpForms.forEach(function(popUpForm) {
    if (popUpForm.contains(event.target)) {
      isOutsidePopUpForm = false;
    }
  });

  if (isOutsidePopUpForm) {
    // Hide all pop-up forms
    popUpForms.forEach(function(popUpForm) {
      popUpForm.style.display = 'none';
    });

    // Hide the overlay
    var popUpOverlay = document.querySelector('.pop-up-overlay');
    popUpOverlay.style.display = 'none';
  }
});


// Handle form submission
var forms = document.querySelectorAll('.pop-up-form form');
forms.forEach(function(form) {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Get form data
        var formData = new FormData(this);

        // Reference to the current form
        var currentForm = this;

        // Send AJAX request to Add_Event.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Add_Event.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from Add_Category.php
                console.log(xhr.responseText);
                // You can display a success message or perform other actions here

                // Hide the pop-up form
                var popUpForm = currentForm.closest('.pop-up-form');
                popUpForm.style.display = 'none';

                // Hide the overlay
                var popUpOverlay = document.querySelector('.pop-up-overlay');
                popUpOverlay.style.display = 'none';

                // Refresh the page
                location.reload();
            }
        };
        xhr.send(formData);
    });
});

