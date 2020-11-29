<?php


namespace App\Controller;


use App\Entity\School;
use App\Exception\SchoolIdGetParameterIsMissingOrNotValidException;
use App\Repository\SchoolRepository;
use Symfony\Component\HttpFoundation\Request;

class AbstractSchoolController extends AbstractController
{
    protected School $school;

//    /** @required
//     * @param SchoolRepository $schoolRepository
//     * @param Request $request
//     * @throws SchoolIdGetParameterIsMissingOrNotValidException
//     */
//    public function assignAndVerifySchool(
//        SchoolRepository $schoolRepository,
//        Request $request
//    ) {
//        $schoolId = (int) $request->get('schoolId', null);
//        $school = $schoolRepository->find($schoolId);
//        if (is_null($school)) {
//            throw new SchoolIdGetParameterIsMissingOrNotValidException($schoolId);
//        }
//        $this->school = $school;
//    }

    protected function throwExceptionUnlessSchoolRoleGranted(string $role)
    {

    }
}