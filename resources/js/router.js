//IMPORT SECTION
import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/dashboard/Index.vue'
import Login from './pages/auth/Login.vue'
import store from './store.js'
/*
    import components disini
*/
// position
import IndexPosition from './pages/position/Index.vue'
import DataPosition from './pages/position/modules/PositionData.vue'
import EditPosition from './pages/position/modules/PositionEdit.vue'
// product
import IndexProduct from './pages/product/Index.vue'
import DataProduct from './pages/product/modules/ProductData.vue'
// report
import IndexReport from './pages/report/Index.vue'
import DataReport from './pages/report/modules/ReportData.vue'
// csReport
import DataCSReport from './pages/report/modules/csReport/ReportCSData.vue'
// import AddCSReport from './pages/report/modules/csReport/ReportCSAdd.vue'
import EditCSReport from './pages/report/modules/csReport/ReportCSEdit.vue'
import ViewCSReport from './pages/report/modules/csReport/ReportCSView.vue'
// advReport
import DataADVReport from './pages/report/modules/advReport/ReportADVData.vue'
import AddADVReport from './pages/report/modules/advReport/ReportADVAdd.vue'
import EditADVReport from './pages/report/modules/advReport/ReportADVEdit.vue'
// stock
import IndexStock from './pages/stock/Index.vue'
import DataStock from './pages/stock/modules/StockData.vue'
// project
import IndexProject from './pages/project/Index.vue'
import DataProject from './pages/project/modules/ProjectData.vue'
// content
import IndexContent from './pages/content/Index.vue'
import DataContent from './pages/content/modules/ContentData.vue'
// team
import IndexTeam from './pages/team/Index.vue'
import DataTeam from './pages/team/modules/TeamData.vue'
import AddTeam from './pages/team/modules/TeamAdd.vue'
import EditTeam from './pages/team/modules/TeamEdit.vue'
import ShowTeam from './pages/team/modules/TeamView.vue'
// setting
import Setting from './pages/setting/Index.vue'
import SetPermission from './pages/setting/roles/SetPermissions.vue'
// inventory
import IndexInventory from './pages/inventory/Index.vue'
import DataInventory from './pages/inventory/module/InventoryData.vue'
import AddInventory from './pages/inventory/module/InventoryAdd.vue'
import EditInventory from './pages/inventory/module/InventoryEdit.vue'
// inventory usage
import InventoryUsage from './pages/inventory/components/InventoryUsage.vue'
import InventoryUsageAdd from './pages/inventory/components/InventoryUsageAdd.vue'
import InventoryUsageShow from './pages/inventory/components/InventoryUsageShow.vue'
Vue.use(Router)

//DEFINE ROUTE
const router = new Router({
    mode: 'history',
    routes: [
        // dashboard route
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true, title: 'Dashboard' }
        },
        // login route
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        // position route
        {
            path: '/position',
            component: IndexPosition,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'position.data',
                    component: DataPosition,
                    meta: { title: 'Manage Position' }
                },
                {
                    path: 'edit/:id',
                    name: 'position.edit',
                    component: EditPosition,
                    meta: { title: 'Edit Position' }
                }
            ],
        },
        // product route
        {
            path: '/product',
            component: IndexProduct,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'product.data',
                    component: DataProduct,
                    meta: { title: 'Manage Product' }
                }
            ],
        },
        // stock route
        {
            path: '/stock',
            component: IndexStock,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'stock.data',
                    component: DataStock,
                    meta: { title: 'Manage Stock' }
                }
            ],
        },
        // report route
        {
            path: '/report',
            component: IndexReport,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'report.data',
                    component: DataReport,
                    meta: { title: 'Manage Report' }
                },
                {
                    path: '/cs-report/:date',
                    name: 'report.data.date',
                    component: ViewCSReport,
                    meta: { title: 'Manage Report' }
                },
                // cs report
                {
                    path: '/cs-report',
                    name: 'cs.report.data',
                    component: DataCSReport,
                    meta: { title: 'Manage Report CS' }
                },
                // {
                //     path: '/cs-report/add',
                //     name: 'cs.report.add',
                //     component: AddCSReport,
                //     meta: { title: 'Add Report CS' }
                // },
                {
                    path: '/cs-report/edit/:id',
                    name: 'cs.report.edit',
                    component: EditCSReport,
                    meta: { title: 'Edit CS' }
                },
                // adv report
                {
                    path: '/adv-report',
                    name: 'adv.report.data',
                    component: DataADVReport,
                    meta: { title: 'Manage Report Adv' }
                },
                {
                    path: '/adv-report/add',
                    name: 'adv.report.add',
                    component: AddADVReport,
                    meta: { title: 'Add Report Adv' }
                },
                {
                    path: '/adv-report/edit/:id',
                    name: 'adv.report.edit',
                    component: EditADVReport,
                    meta: { title: 'Edit Adv' }
                }
            ],
        },
        // project route
        {
            path: '/project',
            component: IndexProject,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'project.data',
                    component: DataProject,
                    meta: { title: 'Manage Project' }
                },
            ],
        },
        // content
        {
            path: '/content',
            component: IndexContent,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'content.data',
                    component: DataContent,
                    meta: { title: 'Manage Content' }
                }
            ],
        },
        // team
        {
            path: '/teams',
            component: IndexTeam,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'teams.data',
                    component: DataTeam,
                    meta: { title: 'Manage Team' }
                },
                {
                    path: 'add',
                    name: 'teams.add',
                    component: AddTeam,
                    meta: { title: 'Manage Add' }
                },
                {
                    path: 'edit/:id',
                    name: 'teams.edit',
                    component: EditTeam,
                    meta: { title: 'Edit Team' }
                },
                {
                    path: ':slug',
                    name: 'teams.show',
                    component: ShowTeam,
                    meta: { title: 'Show Team' }
                }
            ],
        },
        // permissions
        {
            path: '/setting',
            component: Setting,
            meta: { requiresAuth: true },
            children: [
                {
                    path: 'role-permission',
                    name: 'role.permissions',
                    component: SetPermission,
                    meta: { title: 'Set Permissions' }
                },
            ]
        },
        // inventory
        {
            path: '/inventory',
            component: IndexInventory,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'inventory.data',
                    component: DataInventory,
                    meta: { title: 'Manage Inventory' }
                },
                {
                    path: 'edit/:id',
                    name: 'inventory.edit',
                    component: EditInventory,
                    meta: { title: 'Edit Inventory' }
                },
                {
                    path: 'usage',
                    name: 'inventory.usage',
                    component: InventoryUsage,
                    meta: { title: 'Inventory Usage' }
                },
                {
                    path: 'usage-add',
                    name: 'inventory.usage.add',
                    component: InventoryUsageAdd,
                    meta: { title: 'Inventory Usage Add' }
                },
                {
                    path: 'usage-show/:slug',
                    name: 'inventory.usage.show',
                    component: InventoryUsageShow,
                    meta: { title: 'Inventory Usage Show' }
                },
            ],
        },
    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return {
                x: 0, y: 0,
                behavior: 'smooth',
            }
        }
    }
});

//Navigation Guards
router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS')
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router
