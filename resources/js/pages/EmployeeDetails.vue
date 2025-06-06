
<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Company, Employee, type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    employee: {
        data: Employee
    },
    company: {
        data: Company
    }
}>();

const employee = props.employee.data;
const company = props.company.data;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: company.name,
        href: '/companies/' + company.id,
    },
    {
        title: employee.firstName + ' ' + employee.lastName,
        href: '/companies/' + company.id + '/employees/' + employee.id,
    }
];

</script>

<template>
    <Head :title="employee.firstName + ' ' + employee.lastName" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-start gap-4 p-8">
            <h1 class="text-xl font-bold">Employee Details</h1>
            <div>
                <span class="font-semibold">First Name:</span>
                <span class="ml-2">{{ employee.firstName }}</span>
            </div>
            <div>
                <span class="font-semibold">Last Name:</span>
                <span class="ml-2">{{ employee.lastName }}</span>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <span class="ml-2">{{ employee.email }}</span>
            </div>
            <div>
                <span class="font-semibold">Address:</span>
                <span class="ml-2">{{ employee.address }}</span>
            </div>
        </div> 
    </AppLayout>

</template>