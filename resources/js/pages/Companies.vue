<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'My Companies',
        href: '/companies',
    },
];
</script>

<template>
    <Head title="My Companies" />
    <AppLayout :breadcrumbs="breadcrumbs">
    </AppLayout>
</template>