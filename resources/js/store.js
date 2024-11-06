import { createStore } from 'vuex'

export const store = createStore({
    state: {
        asset: null,
        eintro: null,
        showPopUpEditing: false,
        showPopUpDelete: false,
        dIntroId: null,


        // services
        ServicePopupState: false,
        eService: null,
        showServicePopUpDelete: false,
        dServiceId: null,

        // Projects
        ProjectPopupState: false,
        eProject: null,
        showProjectPopUpDelete: false,
        dProjectId: null,

        // Row section
        rowsectionPopupState: false,
        erowsection: null,
        showrowsectionPopUpDelete: false,
        drowsectionId: null,

        // categories
        CategoryPopupState: false,
        eCategory: null,
        showCategoryPopUpDelete: false,
        dCategoryeId: null,

        // Customer
        CustomerPopupState: false,
        eCustomer: null,
        showCustomerPopUpDelete: false,
        dCustomerId: null,

        // object sell
        pps: null,
        ppPopupState: false,
        ppdPopupState: false,
        ppdToDelete: null,
        PpsDeleteTemp: null,
        obj: null,
        objectsellModalState: null,
        objectSellToUpdate: null,
        pushOneTopp: null,
        objToDelete: null,
        objToDeleteModal: false,

        // categories
        categories: null,

        //quotation
        productsForQuot: [],

        // notice
        notice: {
            show: false,
            type: null,
            message: null,
            color: null
        }
    },
    mutations: {
        showNotice($state, $payload) {
            $state.notice.show = true;
            $state.notice.message = $payload.message;
            $state.notice.type = $payload.type;
            $state.notice.color = $payload.color;
        },
        hodeNotice($state, $payload) {
            $state.notice.show = false;
            $state.notice.message = null;
            $state.notice.type = null;
            $state.notice.color = null;
        },
        SetAsset($state, $payload) {
            $state.asset = $payload;
        },
        StartSetEditedIntro($state, $payload) {
            $state.eintro = $payload;
            $state.showPopUpEditing = true;
        },
        EndSetEditedIntro($state) {
            $state.showPopUpEditing = false;
        },
        StartDeleteIntro($state, $payload) {
            $state.showPopUpDelete = true;
            $state.dIntroId = $payload;
        },
        EndDeleteIntro($state) {
            $state.showPopUpDelete = false;
        },
        // start set service store
        StartSetEditServiceState($state, $payload) {
            $state.ServicePopupState = true;
            $state.eService = $payload;
        },
        EndSetEditServiceState($state) {
            $state.ServicePopupState = false;
        },
        StartDeleteService($state, $payload) {
            $state.showServicePopUpDelete = true;
            $state.dServiceId = $payload;
        },
        EndDeleteService($state) {
            $state.showServicePopUpDelete = false;
        },

        // start set Project store
        StartSetEditProjectState($state, $payload) {
            $state.ProjectPopupState = true;
            $state.eProject = $payload;
        },
        EndSetEditProjectState($state) {
            $state.ProjectPopupState = false;
        },
        StartDeleteProject($state, $payload) {
            $state.showProjectPopUpDelete = true;
            $state.dProjectId = $payload;
        },
        EndDeleteProject($state) {
            $state.showProjectPopUpDelete = false;
        },

        //rowsection
        StartSetEditrowsectionState($state, $payload) {
            $state.rowsectionPopupState = true;
            $state.erowsection = $payload;
        },
        EndSetEditrowsectiontState($state) {
            $state.rowsectionPopupState = false;
        },
        StartDeleterowsection($state, $payload) {
            $state.showrowsectionPopUpDelete = true;
            $state.drowsectionId = $payload;
        },
        EndDeleterowsection($state) {
            $state.showrowsectionPopUpDelete = false;
        },

        // start set categories store
        StartSetEditCategoryState($state, $payload) {
            $state.CategoryPopupState = true;
            $state.eCategory = $payload;
        },
        EndSetEditCategoryState($state) {
            $state.CategoryPopupState = false;
        },
        StartDeleteCategory($state, $payload) {
            $state.showCategoryPopUpDelete = true;
            $state.dCategoryId = $payload;
        },
        EndDeleteCategory($state) {
            $state.showCategoryPopUpDelete = false;
        },

        // start set Customer store
        StartSetEditCustomerState($state, $payload) {
            $state.CustomerPopupState = true;
            $state.eCustomer = $payload;
        },
        EndSetEditCustomerState($state) {
            $state.CustomerPopupState = false;
        },
        StartDeleteCustomer($state, $payload) {
            $state.showCustomerPopUpDelete = true;
            $state.dCustomerId = $payload;
        },
        EndDeleteCustomer($state) {
            $state.showCustomerPopUpDelete = false;
        },

        // start set Customer store
        SetPps($state, $payload) {
            $state.pps = $payload;
            $state.obj = $payload.id;
            $state.ppPopupState = true;
        },
        // start set Customer store
        SetPpsDeleteTemp($state, $payload) {
            $state.PpsDeleteTemp = $payload;
        },
        SetPpsDelete($state, $payload) {
            $state.ppdToDelete = $payload;
            $state.ppdPopupState = true;
        },
        EndPpsDelete($state, $payload) {
            $state.ppdToDelete = null;
            $state.ppdPopupState = false;
        },
        endPricingManage($state) {
            $state.pps = null;
            $state.ppPopupState = false;
        },
        startEditObjectState($state, $payload) {
            $state.objectsellModalState = true;
            $state.objectSellToUpdate = $payload;
        },
        EndEditObjectState($state, $payload) {
            $state.objectsellModalState = false;
            $state.objectSellToUpdate = null;
        },
        SetpushOneTopp($state, $payload) {
            $state.pushOneTopp = $payload;
        },
        SetProjectObjIdToDelete($state, $payload) {
            $state.objToDelete = $payload;
            $state.objToDeleteModal = true;
        },
        EndProjectObjIdToDelete($state, $payload) {
            $state.objToDelete = null;
            $state.objToDeleteModal = false;
        },
        setCategories($state, $payload) {
            $state.categories = $payload;
        },
        setproductsForQuot($state, $payload) {
            if ($state.productsForQuot != null) {
                var i = $state.productsForQuot.findIndex(e => e.id == $payload.id);
                if (i != -1) {
                    return;
                } else {
                    $state.productsForQuot.push($payload);
                }
            } else {
                $state.productsForQuot.push($payload);
            }
        },
        RemoveProductForQuot($state, $payload) {
            if ($state.productsForQuot != null) {
                var i = $state.productsForQuot.findIndex(e => e.id == $payload.id);
                if (i != -1) {
                    $state.productsForQuot.splice(i, 1);
                }
            }
        }
    },
    getters: {
        GetAsset($state) {
            return $state.asset
        },
        GetEditedIntro($state) {
            return $state.eintro;
        },
        EditIntroModalState($state) {
            return $state.showPopUpEditing
        },
        DeleteIntroModalState($state) {
            return $state.showPopUpDelete
        },
        GetIdIntroToDelete($state) {
            return $state.dIntroId;
        },
        // state for our service process
        editServicePopupState($state) {
            return $state.ServicePopupState
        },
        editedServices($state) {
            return $state.eService;
        },
        DeleteServiceModalState($state) {
            return $state.showServicePopUpDelete
        },
        GetIdServiceToDelete($state) {
            return $state.dServiceId;
        },

        // Project for our Project process
        editProjectPopupState($state) {
            return $state.ProjectPopupState
        },
        editedProject($state) {
            return $state.eProject;
        },
        DeleteProjectModalState($state) {
            return $state.showProjectPopUpDelete
        },
        GetIdProjectToDelete($state) {
            return $state.dProjectId;
        },

        // rowsection
        edirowsectitonPopupState($state) {
            return $state.rowsectionPopupState
        },
        editedrowsection($state) {
            return $state.erowsection;
        },
        DeleterowsectionModalState($state) {
            return $state.showrowsectionPopUpDelete
        },
        GetIdrowsectionToDelete($state) {
            return $state.drowsectionId;
        },

        // state for our categories process
        editCategoryPopupState($state) {
            return $state.CategoryPopupState
        },
        editedCategory($state) {
            return $state.eCategory;
        },
        DeleteCategoryModalState($state) {
            return $state.showCategoryPopUpDelete
        },
        GetIdCategoryToDelete($state) {
            return $state.dCategoryId;
        },

        // state for our Customer process
        editCustomerPopupState($state) {
            return $state.CustomerPopupState
        },
        GetEditedCustomer($state) {
            return $state.eCustomer;
        },
        DeleteCustomerModalState($state) {
            return $state.showCustomerPopUpDelete
        },
        GetIdCustomerToDelete($state) {
            return $state.dCustomerId;
        },

        // state for object sells process
        editObjectSellppPopupState($state) {
            return $state.ppPopupState
        },
        GetEditedpp($state) {
            return $state.epp;
        },
        getPricingPlan($state) {
            return $state.pps
        },
        getPricingPlanobjectid($state) {
            return $state.obj
        },
        EditobjectsellModalState($state) {
            return $state.objectsellModalState
        },
        GetObjectSellToUpdate($state) {
            return $state.objectSellToUpdate
        },
        GetpushOneTopp($state) {
            return $state.pushOneTopp;
        },
        GetObjToDelete($state) {
            return $state.objToDelete;
        },
        GetModalDeleteState($state) {
            return $state.objToDeleteModal;
        },
        GetPpToDeleteModalState($state) {
            return $state.ppdPopupState;
        },
        GetPpIdToDelete($state) {
            return $state.ppdToDelete;
        },
        GetTempDeleteObj($state) {
            return $state.PpsDeleteTemp;
        },
        getCategories($state) {
            return $state.categories;
        },
        getproductsForQuot($state) {
            return $state.productsForQuot;
        },
        getNotice($state) {
            return $state.notice;
        }
    },
    modules: {

    }
})