import {createApp} from "vue";
import {createMetaManager} from "vue-meta";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from "@fortawesome/fontawesome-svg-core";

import {
    faArrowLeft,
    faArrowRight,
    faArrowUp,
    faArrowUpRightFromSquare,
    faBan,
    faBars,
    faBarsStaggered,
    faBell,
    faBox,
    faBoxArchive,
    faBoxesStacked,
    faBriefcase,
    faBuilding,
    faBuildingUser,
    faC,
    faCalendarDays,
    faChartLine,
    faCheck,
    faChevronDown,
    faChevronLeft,
    faChevronRight,
    faCircleQuestion,
    faCircleUser,
    faCity,
    faClockRotateLeft,
    faCube,
    faCubes,
    faDotCircle,
    faEarthEurope,
    faEllipsis,
    faEnvelope,
    faExclamationCircle,
    faEye,
    faEyeSlash,
    faFile,
    faFileContract,
    faFileImport,
    faFilePdf,
    faFolderPlus,
    faGears,
    faHandshake,
    faHouse,
    faLayerGroup,
    faList,
    faLock,
    faMagnifyingGlass,
    faMap,
    faMapLocationDot,
    faMoneyBills,
    faMoon,
    faMountainSun,
    faNewspaper,
    faPenToSquare,
    faPercent,
    faPhone,
    faPlane,
    faPlus,
    faPrint,
    faServer,
    faShield,
    faShuffle,
    faStar,
    faSuitcase,
    faSun,
    faTable,
    faThumbtack,
    faTrash,
    faTruck,
    faTruckRampBox,
    faUser,
    faUserLock,
    faUserPlus,
    faUsers,
    faUserSecret,
    faUsersRays,
    faWrench,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";
import {notify} from "@/utils/toasts.js";
import "./assets/css/style.css";
import "./assets/css/fonts.css";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import {faSquareXmark} from "@fortawesome/free-solid-svg-icons/faSquareXmark";
import {faTriangleExclamation} from "@fortawesome/free-solid-svg-icons/faTriangleExclamation";
import {faExternalLinkSquare} from "@fortawesome/free-solid-svg-icons/faExternalLinkSquare";

const app = createApp(App); // create the Vue app instance

library.add(faPhone);
library.add(faHouse);
library.add(faChevronLeft);
library.add(faChevronRight);
library.add(faArrowRight);
library.add(faStar)
library.add(faBars);
library.add(faUser);
library.add(faMagnifyingGlass);
library.add(faChevronDown);
library.add(faSun);
library.add(faMoon);
library.add(faUserPlus);
library.add(faServer);
library.add(faExclamationCircle);
library.add(faList);
library.add(faSquareXmark);
library.add(faSuitcase);
library.add(faXmark);
library.add(faCheck);
library.add(faUsers);
library.add(faUsersRays);
library.add(faUserLock);
library.add(faShield);
library.add(faBox);
library.add(faPenToSquare);
library.add(faMap);
library.add(faFile);
library.add(faArrowLeft);
library.add(faBarsStaggered);
library.add(faPlus);
library.add(faBriefcase);
library.add(faBuildingUser);
library.add(faEllipsis);
library.add(faTrash);
library.add(faEarthEurope);
library.add(faArrowUp);
library.add(faGears);
library.add(faLayerGroup);
library.add(faMountainSun);
library.add(faMapLocationDot);
library.add(faBoxesStacked);
library.add(faCircleQuestion);
library.add(faUserSecret)
library.add(faTruck)
library.add(faArrowUpRightFromSquare)
library.add(faFolderPlus)
library.add(faBoxArchive)
library.add(faCalendarDays)
library.add(faClockRotateLeft)
library.add(faBan)
library.add(faEye)
library.add(faWrench)
library.add(faBuilding)
library.add(faPercent)
library.add(faPrint)
library.add(faFileContract)
library.add(faHandshake)
library.add(faCity)
library.add(faTruckRampBox)
library.add(faNewspaper)
library.add(faLock)
library.add(faCircleUser)
library.add(faThumbtack)
library.add(faShuffle)
library.add(faMoneyBills)
library.add(faBell)
library.add(faFileImport)
library.add(faEyeSlash)
library.add(faCubes)
library.add(faCube)
library.add(faPlane)
library.add(faDotCircle)
library.add(faEnvelope)
library.add(faTriangleExclamation)
library.add(faFilePdf)
library.add(faChartLine)
library.add(faExternalLinkSquare)
library.add(faC)
library.add(faTable)

app
    .use(createMetaManager())
    .use(store)
    .use(router)
    .component("font-awesome-icon", FontAwesomeIcon)
    .provide('notify', notify)
    .mount("#app");
