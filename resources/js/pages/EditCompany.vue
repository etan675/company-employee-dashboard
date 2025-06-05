<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Company } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    company: {
        data: Company
    }
}>();
const company = props.company.data;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: company.name,
        href: `/companies/${company.id}`
    },
    {
        title: 'Edit',
        href: `/companies/${company.id}/edit`
    },
];
</script>

<template>
    <Head :title="'Edit Company Details'" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- TODO: implement edit company page -->
    </AppLayout>
</template>