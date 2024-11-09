<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import moment from 'moment';

export default {
    name: "History",
    components: {
        Mainlayout: MainLayout
    },
    props: {
        logs: Array
    },
    methods: {
        formatDate(date) {
            return moment(date).format('DD.MM.YYYY HH:mm');
        },
    },
    mounted() {
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
                <tr v-for="log in logs" :key="log.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ formatDate(log.created_at) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ log.message }}
                    </td>
                    <td class="px-6 py-4">
                        {{ log.is_success ? 'Успешно' : 'Не успешно' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </Mainlayout>
</template>

<style scoped>

</style>
