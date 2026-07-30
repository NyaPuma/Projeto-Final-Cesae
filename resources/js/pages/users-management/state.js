export const usersState = {
    currentPage: 1,
    profilesLoaded: false,
};

export function setCurrentPage(page) {
    usersState.currentPage = page;
}

export function markProfilesLoaded() {
    usersState.profilesLoaded = true;
}
