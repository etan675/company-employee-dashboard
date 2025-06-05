<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Create Company',
        href: '/companies/new'
    },
];

</script>

<template>
    <Head :title="'Create Company'" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- TODO: implement create company page -->
    </AppLayout>
</template>