<template>
    <div
        v-if="source"
        class="px-0">
        <div v-if="source.data" class="rounded-lg overflow-x-auto text">
            <table
                :class="[{ 'pe-none': spinner }, { 'archiveTable' : $route.name === 'ArchiveGroups' }]"
                class="hidden lg:block custom-table dark:border-darkElBg text-black dark:text-darkText min-w-full bg-white dark:bg-darkElBg "
            >
                <div v-if="spinner"
                     class="position-absolute d-flex align-items-baseline h-100 w-100 top-0 bg-white bg-opacity-50"
                     style="z-index: 2"
                >
                    <div class="position-sticky top-50 start-50 translate-middle">
                        <span class="spinner-border text-primary"/>
                    </div>
                </div>
                <thead
                    :class="{ 'top-0': !source?.hasOwnProperty('total') }"
                    class="position-sticky text-left bg-[#F3F2F7] dark:bg-darkInp"
                >
                <tr>
                    <th
                        v-for="(column, key) in columns"
                        :key="key"
                        class="cursor-pointer p-2 font-bold text-[#757575] dark:text-darkText text-xs whitespace-nowrap"
                        @click="handleSortClick(column.fname)"
                    >
                        {{ column.name }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="!spinner && !source?.data.length">
                    <td :colspan="columns.length" class="text-center py-4 font-medium">
                        <NoItemsLeft/>
                    </td>
                </tr>
                <template v-else>
                    <tr
                        v-for="(row, key) in source?.data"
                        :key="key"
                        :class="colorBG ? colorBG : ''"
                        class="whitespace-nowrap lg:whitespace-normal text-sm"
                    >
                        <td
                            v-for="(column, index) in columns"
                            :key="index"
                            :class="[column.tdClass, { 'position-relative': linked }]"
                            :data-column-name="column.name"
                            class="p-2 border-b border-gray-300 dark:border-gray-600"
                        >
                            <slot
                                :column="column"
                                :index="key"
                                :row="row"
                                :val-from="getValFrom"
                            >
                                {{ getValFrom(row, column, index) }}
                            </slot>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
            <div
                :class="{ 'pe-none': spinner }"
                class="block lg:hidden text-[#757575] dark:text-darkText dark:bg-darkElBg text-sm"
            >
                <div
                    v-if="spinner"
                    class="position-absolute d-flex align-items-baseline h-100 w-100 top-0 bg-white bg-opacity-50"
                    style="z-index: 2"
                >
                    <div class="position-sticky top-50 start-50 translate-middle">
                        <span class="spinner-border text-primary"/>
                    </div>
                </div>
                <div>
                    <div v-if="!spinner && !source?.data.length">
                        <div :colspan="columns.length" class="text-center py-4 font-medium">
                            <NoItemsLeft/>
                        </div>
                    </div>
                    <template v-else>
                        <div>
                            <div
                                v-for="(row, key) in source?.data"
                                :key="key"
                                :class="{ '!h-full !text-clip': openedTab[key] }"
                                class="text-sm h-48 border-b py-3 pb-10 truncate relative"
                            >
                                <div
                                    class="absolute w-full bottom-0 py-2 text-center bg-gray-50 dark:bg-darkInp"
                                    @click="openTab(key)"
                                >
                                    <font-awesome-icon
                                        :class="{ 'rotate-180': openedTab[key] }"
                                        :icon="['fas', 'chevron-down']"
                                    />
                                </div>
                                <div>
                                    <div
                                        v-for="(column, index) in columns"
                                        :key="index"
                                        :class="[column.tdClass, { 'position-relative': linked }]"
                                        :data-column-name="column.name"
                                        class="p-2 text-sm border-gray-300 dark:border-gray-600 text-left"
                                    >
                                        <p class=" text-sm mb-1">{{ column.name }}</p>
                                        <slot
                                            :column="column"
                                            :index="key"
                                            :row="row"
                                            :val-from="getValFrom"
                                        >
                                            {{ getValFrom(row, column, index) }}
                                        </slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div v-else class="rounded-lg">
            <table
                :class="[{ 'pe-none': spinner }, { 'archiveTable' : $route.name === 'ArchiveGroups' }]"
                class="hidden lg:block custom-table dark:border-darkElBg text-black dark:text-darkText min-w-full bg-white dark:bg-darkElBg  overflow-x-auto"
            >
                <div
                    v-if="spinner"
                    class="position-absolute d-flex align-items-baseline h-100 w-100 top-0 bg-white bg-opacity-50"
                    style="z-index: 2"
                >
                    <div class="position-sticky top-50 start-50 translate-middle">
                        <span class="spinner-border text-primary"/>
                    </div>
                </div>
                <thead
                    :class="{ 'top-0': !source?.hasOwnProperty('total') }"
                    class="position-sticky text-left bg-[#F3F2F7] dark:bg-darkInp"
                >
                <tr>
                    <th
                        v-for="(column, key) in columns"
                        :key="key"
                        class="p-2 font-bold text-[#757575] dark:text-darkText text-xs whitespace-nowrap"
                    >
                        {{ column.name }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="!spinner && !source?.length">
                    <td :colspan="columns.length" class="text-center py-4 font-medium">
                        <NoItemsLeft/>
                    </td>
                </tr>
                <template v-else>
                    <tr
                        v-for="(row, key) in source"
                        :key="key"
                        class="whitespace-nowrap lg:whitespace-normal text-sm"
                    >
                        <td
                            v-for="(column, index) in columns"
                            :key="index"
                            :class="[column.tdClass, { 'position-relative': linked }]"
                            :data-column-name="column.name"
                            class="p-2 border-b border-gray-300 dark:border-gray-600"
                        >
                            <slot
                                :column="column"
                                :index="key"
                                :row="row"
                                :val-from="getValFrom"
                            >
                                {{ getValFrom(row, column, index) }}
                            </slot>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
            <div
                :class="{ 'pe-none': spinner }"
                class="block lg:hidden text-[#757575] dark:text-darkText dark:bg-darkElBg text-sm"
            >
                <div
                    v-if="spinner"
                    class="position-absolute d-flex align-items-baseline h-100 w-100 top-0 bg-white bg-opacity-50"
                    style="z-index: 2"
                >
                    <div class="position-sticky top-50 start-50 translate-middle">
                        <span class="spinner-border text-primary"/>
                    </div>
                </div>
                <div>
                    <div v-if="!spinner && !source?.length">
                        <div :colspan="columns.length" class="text-center py-4 font-medium">
                            <NoItemsLeft/>
                        </div>
                    </div>
                    <template v-else>
                        <div class="">
                            <div
                                v-for="(row, key) in source"
                                :key="key"
                                :class="{ '!h-full !text-clip': openedTab[key] }"
                                class="text-sm h-48 border-b py-3 pb-10 truncate relative"
                            >
                                <div
                                    class="absolute w-full bottom-0 py-2 text-center bg-gray-50 dark:bg-darkInp"
                                    @click="openTab(key)"
                                >
                                    <font-awesome-icon
                                        :class="{ 'rotate-180': openedTab[key] }"
                                        :icon="['fas', 'chevron-down']"
                                    />
                                </div>
                                <div>
                                    <div
                                        v-for="(column, index) in columns"
                                        :key="index"
                                        :class="[column.tdClass, { 'position-relative': linked }]"
                                        :data-column-name="column.name"
                                        class="py-2 lg:py-3 px-3 text-sm border-gray-300 dark:border-gray-600 text-left"
                                    >
                                        <p class=" text-sm mb-1">{{ column.name }}</p>
                                        <slot
                                            :column="column"
                                            :index="key"
                                            :row="row"
                                            :val-from="getValFrom"
                                        >
                                            {{ getValFrom(row, column, index) }}
                                        </slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div
            v-if="pagination"
            class="block lg:flex items-center justify-center lg:justify-between px-4 mt-4"
        >
            <PageInfo :pages-data="pagination" class="mb-3 lg:mb-0"/>
            <Pagination :pages-data="pagination" @first-link="secondLink"/>
        </div>
    </div>
</template>

<script>
import Pagination from "./Pagination.vue";
import PageInfo from "./PageInfo.vue";
import NoItemsLeft from "@/components/NoItemsLeft.vue";

export default {
    name: "TableComponent",
    components: {
        NoItemsLeft,
        Pagination,
        PageInfo,
    },
    props: {
        colorBG: {
            type: String,
            required: false
        },
        prefix: {
            type: String,
            required: false,
        },
        pagination: {
            type: Object,
            required: false,
        },
        columns: {
            type: Array,
            required: false,
        },
        source: {
            type: [Object, null],
            required: false,
        },
        spinner: {
            type: Boolean,
            default: false,
        },
        linked: {
            type: Boolean,
            default: false,
        },
    },
    emits: ["call_to_refresh", "sort-data"],
    data() {
        return {
            openedTab: [],
            sortDirection: "desc"
        };
    },
    mounted() {
        this.openedTab = this.source.data.map(() => false);
    },

    methods: {
        handleSortClick(fname) {
            this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc'
            this.$emit("sort-data", fname, this.sortDirection)
        },
        getValFrom: (row, column) =>
            column.fname.split(".").reduce((prev, curr) => {
                if ([null, undefined].includes(prev)) return;
                return prev[curr];
            }, row),
        secondLink(value) {
            this.$emit("call_to_refresh", value);
        },
        openTab(key) {
            this.openedTab = this.openedTab.map((value, i) =>
                i === key ? !value : false
            );
        },
        handleOutsideClick(event) {
            this.openedTab.forEach((el) => {
                if (el && !this.$el.contains(event.target)) {
                    el = false;
                }
            });
        },
    },
};
</script>

<style scoped>
table {
    table-layout: fixed;
    width: 100%;
}

td {
    width: 5%;
}
</style>
