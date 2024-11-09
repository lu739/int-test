<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import moment from 'moment';
import { route } from 'ziggy-js';
export default {
    name: "History",
    components: {
        Mainlayout: MainLayout
    },
    data() {
        return {
            events: [],
            eventTypes: Object,
        }
    },
    methods: {
        formatDate(date) {
            return moment.unix(date).format('DD.MM.YYYY HH:mm');
        },

        fetchEvents() {
            axios.get(route('get-events'))
                .then(response => {
                    this.events = response.data?.data?._embedded?.events ?? [];
                })
                .catch(error => {
                    console.error(error);
                });
        },

        fetchEventTypes() {
            axios.get(route('get-event-types'))
                .then(response => {
                    const eventTypesArray = response.data?.data?._embedded?.events_types ?? [];
                    if (eventTypesArray.length > 0) {
                        this.eventTypes = eventTypesArray.reduce((accumulator, item) => {
                            accumulator[item.key] = item.lang;
                            return accumulator;
                        }, {});
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
    mounted() {
        this.fetchEventTypes();
        this.fetchEvents();
    }
}
</script>

<template>
    <Mainlayout>
        <h1 class="font-bold mb-2 text-2xl">История (Лог)</h1>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Дата и время
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Действие
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Результат
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in events" :key="event.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ formatDate(event.created_at) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ this.eventTypes[event.type] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ event.value_before }} => {{ event.value_after }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </Mainlayout>
</template>

<style scoped>

</style>
