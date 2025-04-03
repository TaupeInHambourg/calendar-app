addEventListener('DOMContentLoaded', () => {
  //TODO: Function to open a modal to add a new lesson in the database
  function addLesson(lesson) {
    console.log('TEST ON ADD: ', lesson);
  }

  //TODO: Function to update a lesson in the database
  function updateLesson(lesson) {
    console.log('TEST SET DATA: ', lesson);
  }
  //   jQuery.ajax({
  //     type: "POST",
  //     url: 'your_functions_address.php',
  //     dataType: 'json',
  //     data: {functionname: 'add', arguments: [1, 2]},

  //     success: function (obj, textstatus) {
  //                   if( !('error' in obj) ) {
  //                       yourVariable = obj.result;
  //                   }
  //                   else {
  //                       console.log(obj.error);
  //                   }
  //             }
  // });

  // Make the elements draggable using Sortable.js
  const targetDragEl = document.querySelector('.modules')
  const targetDropEl = document.querySelectorAll('.calendar')
  console.log('TARGETS', targetDragEl, targetDropEl)

  targetDropEl.forEach((element) => {
    Sortable.create(element, {
      draggable: '.lesson',
      group: {
        name: 'moveLesson',
      },
      animation: 150,
      setData: updateLesson(DataTransfer)
    });

    Sortable.create(element, {
      draggable: '.lesson',
      group: {
        name: 'addLesson',
        pull: 'clone'
      },
      animation: 150,
      onAdd: addLesson(element)
    });
  });

  Sortable.create(targetDragEl, {
    group: {
      name: 'addLesson',
      pull: 'clone',
      put: false
    },
    animation: 150
  });

})