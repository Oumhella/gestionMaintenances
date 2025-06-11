import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,

        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
                const response = await axios.get('/dashboard/maintenance_preventive/planning_annuel/events/fetch', {
                    params: {
                        start: fetchInfo.startStr,
                        end: fetchInfo.endStr,
                    },
                });
                successCallback(response.data);
            } catch (error) {
                console.error('Failed to fetch events:', error);
                failureCallback(error);
            }
        },

        select: function (info) {
            document.getElementById('event-id').value = '';
            document.getElementById('event-title').value = '';
            document.getElementById('event-start').value = info.startStr;
            document.getElementById('event-end').value = info.endStr;

            document.getElementById('event-form').style.display = 'flex';
        },

        eventClick: function (info) {
            document.getElementById('event-id').value = info.event.id || '';
            document.getElementById('event-title').value = info.event.title || '';
            document.getElementById('event-start').value = info.event.startStr || '';
            document.getElementById('event-end').value = info.event.endStr || '';

            document.getElementById('event-form').style.display = 'flex';
        },
    });

    calendar.render();

    // Handle event form submission
    document.getElementById('calendarEventForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const id = document.getElementById('event-id').value;
        const title = document.getElementById('event-title').value;
        const start = document.getElementById('event-start').value;
        const end = document.getElementById('event-end').value;

        try {
            await axios.post('/dashboard/maintenance_preventive/planning_annuel/events/store', {
                id,
                title,
                start,
                end,
            });

            document.getElementById('event-form').style.display = 'none';
            calendar.refetchEvents(); // Refresh calendar events
        } catch (error) {
            console.error('Event save failed:', error.response ? error.response.data : error);
        }
    });

    // Handle close form button
    document.getElementById('closeForm').addEventListener('click', function () {
        document.getElementById('event-form').style.display = 'none';
    });
});
