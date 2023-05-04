document.addEventListener('DOMContentLoaded', () => 

{
  const editButtons = document.querySelectorAll('[id^="edit-icon-"]');

  const formContainer = document.querySelector('#form-container');

  const createForm = document.querySelector('#create-form');

  editButtons.forEach((editButton) => 
  
  {
    editButton.addEventListener('click', (event) => 
    
    {
      event.preventDefault();

      // Hide create form if it's currently displayed

      if (createForm.style.display !== 'none') 
      
      {
        createForm.style.display = 'none';
      }

    // Get the news id, title, and description from the edit button's data attributes

    const newsId = editButton.dataset.id;

    const newsTitle = editButton.dataset.title;

    const newsDescription = editButton.dataset.description;

    // Build the URL for the fetch request, including the news id, title, and description as query parameters

    const url = `/views/edit.php?id=${newsId}&title=${encodeURIComponent(newsTitle)}&description=${encodeURIComponent(newsDescription)}`;

        fetch(url)

          .then((response) => response.text())

          .then((data) => 
          
          {
            formContainer.innerHTML = data;

            // Populate the title and description fields with the values from the edit button's data attributes

            const titleInput = formContainer.querySelector('#edit-title');

            const descriptionInput = formContainer.querySelector('#edit-description');

            titleInput.value = newsTitle;
            
            descriptionInput.value = newsDescription;

          });

        });
        
      });
      
    });
