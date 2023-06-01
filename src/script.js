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
        xhr.open('POST', 'src/Add_Event.php', true);
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

// Assuming you have an array of date elements with class "day_num"
var dateElements = document.querySelectorAll('.day_num');

// Get the month dropdown and year input field
var monthDropdown = document.querySelector('select[name="dropdown"]');
var yearInput = document.querySelector('input[name="year"]');

// Attach click event handler to each date element
dateElements.forEach(function(dateElement) {
  dateElement.addEventListener('click', function() {
    var selectedDate = this.textContent.trim(); // Get the selected date value
    var selectedMonth = monthDropdown.value; // Get the selected month value from the dropdown
    var selectedYear = yearInput.value; // Get the selected year value from the input field

    var selectedDateFull = selectedYear + '-' + selectedMonth + '-' + selectedDate; // Combine date, month, and year

    // Make an AJAX request to fetch the events for the selected month, year, and date
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'src/get_events.php?selected_date=' + selectedDateFull, true); // Replace with the actual endpoint to fetch events
    xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 400) {
        // Update the content of the event list element in the header
        document.getElementById('event-list').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });
});


// Show Description upon clicking the event name in the left side when
document.addEventListener('click', function(event) {
  if (event.target.matches('.eventHeader')) {
    // Toggle the visibility of the event description
    var description = event.target.parentNode.querySelector('.event-description-container');
    // Check whether the display is set to none, if not then make it none
    if (description.style.display === 'none' || description.style.display === '') {
      description.style.display = 'block';
    } else {
      description.style.display = 'none';
    }
  }
});

// Delete Event Script/Logic
document.addEventListener('click', function(event) {
  if (event.target.matches('.delete-button')) {
    // Get the event ID from the data attribute
    var eventId = event.target.getAttribute('data-event-id');
    
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Set up the request
    xhr.open('GET', 'src/delete_event.php?event_id=' + eventId);
    
    // Define the callback function for when the request completes
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Event deleted successfully, remove it from the DOM
        var eventElement = event.target.closest('.eventElement');
        eventElement.remove();
      } else {
        // Error occurred, handle accordingly
        console.log('Failed to delete the event.');
      }
    };
    
    // Define the callback function for when an error occurs
    xhr.onerror = function() {
      // Error occurred, handle accordingly
      console.log('An error occurred while deleting the event.');
    };
    
    // Send the request
    xhr.send();

    // Refresh the page
    location.reload();
  }
});

// Show Delete Button for Each Category
document.addEventListener('click', function(event) {
  if (event.target.matches('.element')) {
    // Toggle the visibility of the Category description
    var deleteCategory = event.target.parentNode.querySelector('.delete-category');
    // Check whether the display is set to none, if not then make it none
    if (deleteCategory.style.display === 'none' || deleteCategory.style.display === '') {
      deleteCategory.style.display = 'block';
    } else {
      deleteCategory.style.display = 'none';
    }
  }
});

// Delete Category Script/Logic
document.addEventListener('click', function(event) {
  if (event.target.matches('.delete-category')) {
    // Get the event ID from the data attribute
    var categoryId = event.target.getAttribute('data-category-id');
    
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Set up the request
    xhr.open('GET', 'src/delete_category.php?category_id=' + categoryId);
    
    // Define the callback function for when the request completes
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Event deleted successfully, remove it from the DOM
        var element = event.target.closest('.element');
        element.remove();
        
        // Refresh the page
        location.reload();
      } else {
        // Error occurred, handle accordingly
        console.log('Failed to delete the category.');
      }
    };
    
    // Define the callback function for when an error occurs
    xhr.onerror = function() {
      // Error occurred, handle accordingly
      console.log('An error occurred while deleting the event.');
    };
    
    // Send the request
    xhr.send();
  }
});

// Add Category Script
// Add event listener to the "+" button
var addButton = document.querySelector('#add-category-button');
addButton.addEventListener('click', function(event) {
  event.stopPropagation(); // Prevent click event from propagating to the document

  // Hide all pop-up forms
  var popUpForms = document.querySelectorAll('.pop-up-form-category');
  popUpForms.forEach(function(popUpForm) {
    popUpForm.style.display = 'none';
  });

  // Show the pop-up form
  var popUpForm = document.getElementById('popUpFormCategory');
  popUpForm.style.display = 'block';

  // Show the overlay
  var popUpOverlay = document.querySelector('.pop-up-overlay-category');
  popUpOverlay.style.display = 'block';

  // Add click event listener to the document
  document.addEventListener('click', closePopUpForm);
});

// Function to close the pop-up form and overlay
function closePopUpForm(event) {
  var popUpForm = document.getElementById('popUpFormCategory');
  var popUpOverlay = document.querySelector('.pop-up-overlay-category');

  // Check if the click event occurred outside the pop-up form
  if (!popUpForm.contains(event.target)) {
    // Hide the pop-up form
    popUpForm.style.display = 'none';

    // Hide the overlay
    popUpOverlay.style.display = 'none';

    // Remove the click event listener from the document
    document.removeEventListener('click', closePopUpForm);
  }
}

// Handle form submission
var forms = document.querySelectorAll('.pop-up-form-category form');
forms.forEach(function(form) {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Get form data
        var formData = new FormData(this);

        // Reference to the current form
        var currentForm = this;

        // Send AJAX request to Add_Category.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'src/Add_Category.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from Add_Category.php
                console.log(xhr.responseText);
                // You can display a success message or perform other actions here

                // Hide the pop-up form
                var popUpForm = currentForm.closest('.pop-up-form-category');
                popUpForm.style.display = 'none';

                // Hide the overlay
                var popUpOverlay = document.querySelector('.pop-up-overlay-category');
                popUpOverlay.style.display = 'none';

                // Refresh the page
                location.reload();
            }
        };
        xhr.send(formData);
    });
});

