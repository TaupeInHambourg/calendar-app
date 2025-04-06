// Add this to your SingleCalendar.php script section or create a separate JS file

document.addEventListener('DOMContentLoaded', function () {
  // Initialize Sortable for modules
  const modulesList = document.querySelector('.modules');
  Sortable.create(modulesList, {
    group: {
      name: 'modules',
      pull: 'clone',
      put: false
    },
    sort: false,
    onClone: function (evt) {
      const item = evt.item;
      const moduleId = item.getAttribute('data-module-id');
      item.classList.add('module-clone');
      item.setAttribute('data-dragged-module-id', moduleId);
    }
  });

  // Initialize Sortable for calendar days
  document.querySelectorAll('.calendar').forEach(calendarDay => {
    Sortable.create(calendarDay, {
      group: {
        name: 'lessons',
        put: ['modules', 'lessons']
      },
      onAdd: function (evt) {
        const item = evt.item;
        const targetDate = getDateFromCalendarCell(evt.to);

        if (item.classList.contains('module-clone')) {
          // Handle dropping a module onto a calendar day
          const moduleId = item.getAttribute('data-dragged-module-id');

          // Make AJAX call to create a new lesson
          fetch('/drag-drop', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'createLesson',
              moduleId: moduleId,
              date: targetDate
            })
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Replace the cloned module with proper lesson component
                renderLessonComponent(data.lesson, item);
              } else {
                // Handle error
                console.error('Failed to create lesson:', data.error);
                item.remove(); // Remove the clone if failed
              }
            })
            .catch(error => {
              console.error('Error:', error);
              item.remove();
            });
        } else {
          // Handle moving a lesson to a different day
          const lessonId = item.getAttribute('data-lesson-id');

          // Make AJAX call to update lesson date
          fetch('/drag-drop', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'moveLesson',
              lessonId: lessonId,
              newDate: targetDate
            })
          })
            .then(response => response.json())
            .then(data => {
              if (!data.success) {
                // If failed, move back to original position
                console.error('Failed to update lesson:', data.error);
                // Here you would need to handle moving the item back
              }
            })
            .catch(error => {
              console.error('Error:', error);
              // Handle error
            });
        }
      }
    });
  });

  // Helper function to get date from calendar cell
  function getDateFromCalendarCell(cell) {
    const day = cell.querySelector('.day').textContent.trim();
    const monthYear = document.querySelector('.text-2xl.font-bold').textContent.trim();
    const [month, year] = monthYear.split(' ');

    // Convert month name to number
    const months = {
      'Janvier': '01', 'Février': '02', 'Mars': '03', 'Avril': '04',
      'Mai': '05', 'Juin': '06', 'Juillet': '07', 'Août': '08',
      'Septembre': '09', 'Octobre': '10', 'Novembre': '11', 'Décembre': '12'
    };

    const monthNum = months[month];
    const paddedDay = day.padStart(2, '0');

    return `${year}-${monthNum}-${paddedDay} 09:00:00`; // Default to 9 AM
  }

  // Helper function to render a lesson component dynamically
  function renderLessonComponent(lesson, container) {
    // Create a new lesson element
    const lessonElement = document.createElement('div');
    lessonElement.className = 'lesson event-list p-1 mt-2 rounded-lg overflow-y-auto min-h-fit';
    lessonElement.setAttribute('data-lesson-id', lesson.id);

    // Get the color from the server or set a default
    fetch(`/lesson-color/${lesson.id}`)
      .then(response => response.json())
      .then(data => {
        lessonElement.style.backgroundColor = data.color;
      })
      .catch(() => {
        // Default color if we can't get it
        lessonElement.style.backgroundColor = '#3498db';
      });

    // Add the lesson name
    const lessonName = document.createElement('div');
    lessonName.className = 'text-sm rounded p-1 mt-1';
    lessonName.textContent = lesson.name;

    lessonElement.appendChild(lessonName);

    // Replace the container with the new lesson element
    container.parentNode.replaceChild(lessonElement, container);
  }
});