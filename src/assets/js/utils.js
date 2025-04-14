/**
 * utils.js - Fonctions utilitaires
 */

// Convertit le nom du mois en numéro
function getMonthNumber(monthName) {
  const months = {
    'Janvier': '01', 'Février': '02', 'Mars': '03', 'Avril': '04',
    'Mai': '05', 'Juin': '06', 'Juillet': '07', 'Août': '08',
    'Septembre': '09', 'Octobre': '10', 'Novembre': '11', 'Décembre': '12'
  };
  return months[monthName] || '01';
}

// Récupère la date à partir d'une cellule du calendrier
function getDateFromCalendarCell(cell) {
  const day = cell.querySelector('.day').textContent.trim();
  const monthYear = document.querySelector('.text-2xl.font-bold').textContent.trim();
  const [monthName, year] = monthYear.split(' ');

  const monthNum = getMonthNumber(monthName);
  const paddedDay = day.padStart(2, '0');

  return {
    dateStr: `${year}-${monthNum}-${paddedDay}`,
    dateTimeStr: `${year}-${monthNum}-${paddedDay} 09:00:00` // Default to 9 AM
  };
}

// Formate une date en chaîne ISO
function formatDateTime(date, time) {
  return `${date} ${time}`;
}

// Exporte les fonctions
export {
  getMonthNumber,
  getDateFromCalendarCell,
  formatDateTime
};